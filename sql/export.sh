#!/bin/sh
pg_dump -d superliga -h localhost -U postgres -p 5432  -W -O -x > db.sql
