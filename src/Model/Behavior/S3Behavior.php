<?php

declare(strict_types=1);

/**
 * Proffer
 * An upload behavior plugin for CakePHP 3
 *
 * @author David Yell <neon1024@gmail.com>
 */

namespace App\Model\Behavior;

use ArrayObject;
use Cake\Database\Type;
use Cake\Core\Configure;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Behavior;
use Psr\Http\Message\UploadedFileInterface;

use Aws\S3\S3Client;





/**
 * Proffer behavior
 */
class S3Behavior extends Behavior
{

    protected $s3;

    protected $_defaultConfig = [
        'fields' => [],
        's3' => [
            'bucket'=>'',
            'key' => '',
            'secret' => '',
            'region' => 'eu-central-1',
            'version'=> 'latest',

        ],
    ];


    public function initialize(array $config): void
    {
        // Instantiate an Amazon S3 client.
        $config = $this->getConfig();

        $s3 = [
            'bucket' => Configure::read('S3.bucket','jugada-afa'),
            'key' => Configure::read('S3.key','AKIA4SDQRKCJUF2MPI32'),
            'secret' => Configure::read('S3.secret','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'),
            'region' => Configure::read('S3.region','sa-east-1'),
            'version'=> Configure::read('S3.version','latest'),
        ];

        $config['s3'] = $s3;

        $this->setConfig($config);

        $this->s3 = S3Client::factory([
            'credentials' => [
                'key' => $config['s3']['key'],
                'secret' => $config['s3']['secret']
            ],
            'region' => $config['s3']['region'],
            'version' => $config['s3']['version']
        ]);


        Type::map('s3.file', '\App\Database\Type\FileType');
        $schema = $this->_table->getSchema();
        foreach (array_values($this->getConfig()['fields']) as $field) {
            if (is_string($field)) {
                $schema->setColumnType($field, 's3.file');
            }
        }
        $this->_table->setSchema($schema);
    }

    /**
     * beforeMarshal event
     *
     * If a field is allowed to be empty as defined in the validation it should be unset to prevent processing
     *
     * @param \Cake\Event\Event $event Event instance
     * @param \ArrayObject $data Data to process
     * @param \ArrayObject $options Array of options for event
     *
     * @return void
     */
    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        foreach ($this->getConfig()['fields'] as $field) {
            if (!isset($data[$field])) {
                continue;
            }
            /** @var \Laminas\Diactoros\UploadedFile $upload */
            $upload = $data[$field];
            if (
                $this->_table->getValidator()->isEmptyAllowed($field, false) &&
                $upload instanceof UploadedFileInterface &&
                $upload->getError() === UPLOAD_ERR_NO_FILE
            ) {
                unset($data[$field]);
            }
        }
    }

    /**
     * beforeSave method
     *
     * Hook the beforeSave to process the request data
     *
     * @param \Cake\Event\Event $event The event
     * @param \Cake\Datasource\EntityInterface $entity The entity
     * @param \ArrayObject $options Array of options
     *
     * @return true
     * @throws \Exception
     */
    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        foreach ($this->getConfig()['fields'] as $field) {
            if ($entity->has($field) && $entity->get($field) instanceof UploadedFileInterface) {
                if ($entity->get($field)->getError() === UPLOAD_ERR_OK) {
                    $this->process($field, $entity);
                } else {
                    throw new \Exception("Cannot find anything to process for the field `$field`");
                }
            }
        }

        return true;
    }

    /**
     * Process any uploaded files, generate paths, move the files and kick off thumbnail generation if it's an image
     *
     * @param string $field The upload field name
     * @param array $settings Array of upload settings for the field
     * @param \Cake\Datasource\EntityInterface $entity The current entity to process
     * @param \Proffer\Lib\ProfferPathInterface|null $path Inject an instance of ProfferPath
     *
     * @return void
     * @throws \Exception If the file cannot be renamed / moved to the correct path
     */
    protected function process($field, EntityInterface $entity)
    {
        $config = $this->getConfig();
        if ($entity->get($field) instanceof UploadedFileInterface && !\is_array($entity->get($field))) {
            $uploadList = [$entity->get($field)];
        } else {
            $uploadList = $entity->get($field);
        }

        foreach ($uploadList as $upload) {
            /** @var \Laminas\Diactoros\UploadedFile $upload */
            try {

                $tmp = $upload->getStream()->getMetadata('uri');

                $objects = $this->s3->putObject([
                    'Bucket'       => $config['s3']['bucket'],
                    'Key'          => $this->table()->getTable() . '/' . $upload->getClientFilename(),
                    'SourceFile'   => $tmp,
                    'ContentType'  => mime_content_type($tmp),
                    'ACL'          => 'public-read',
                    'StorageClass' => 'REDUCED_REDUNDANCY'
                ]);

                $entity->set($field, $objects->get('ObjectURL'));


            } catch (\Exception $e) {
                throw $e;
            }
        }

        unset($path);
    }

}
