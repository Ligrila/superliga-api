<?php
return [
  'dateWidget' => '{{day}}{{month}}{{year}}{{hour}}{{minute}}{{second}}{{meridian}}',
  'inputContainer' => '<div class="form-group form-md-line-input form-md-floating-label {{type}}{{required}}">{{content}}</div>',
  'inputContainerError' => '<div class="alert-danger form-group form-md-line-input form-md-floating-label {{type}}{{required}}">{{content}}{{error}}</div>',
  'input' => '<input class="form-control" type="{{type}}" name="{{name}}"  autocomplete="off" {{attrs}}/>',
  //'checkbox' => '<span class="check"></span><span class="box"></span><input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}></input>',
  'textarea' => '<textarea class="form-control" type="{{type}}" name="{{name}}"  {{attrs}}>{{value}}</textarea>',
  'label' =>'<label for="name">{{text}}</label>',
  'selectFormGroup'=>'{{label}}{{input}}',
  'datetimeFormGroup'=>'<div><div>{{label}}</div>{{input}}</div>',
  'dateFormGroup'=>'<div><div>{{label}}</div>{{input}}</div>',
  'formGroup'=>'{{input}}{{label}}'

];

