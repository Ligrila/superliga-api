#!/bin/sh
pg_dump -d superliga_copy -h superliga.postgre -U superliga -p 5433  -W -O -x > db.sql
