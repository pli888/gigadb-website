# Tools for GigaDB: dataset-backup-tool

## Introduction

This project offers a tool implemented as Yii2 Console command for backing up
data files into [Tencent Cloud Object Storage](https://intl.cloud.tencent.com/product/cos).
This Yii2 tool uses [RClone](https://rclone.org) whose commands have been 
wrapped within thin wrapper scripts:

  * `gigadb/app/tools/dataset-backup-tool/scripts/sync_files.sh` for the
    incremental backup
  * `gigadb/app/tools/dataset-backup-tool/scripts/delete_files.sh` for
    deleting a file

## Set up

Change into the working directory for this tool:
```
$  cd gigadb/app/tools/dataset-backup-tool/
```

Install Composer dependencies
```
$  composer install 
```

There are two configuration files which are required by the tool:

`cos.conf` in the `dataset-backup-tool/config` directory provides the tool with
the credentials for accessing the Tencent COS API. This configuration file is
automatically generated when running `$ docker-compose run --rm config` using 
the `TENCENTCLOUD_SECRET_ID`, `TENCENTCLOUD_SECRET_KEY`, `TENCENTCLOUD_APP_ID`
variables which need to be available as GitLab secrets.

A centralised `variables` file is required in `dataset-backup-tool/config` 
directory to configure the location of the source directory containing the 
sub-directories and files that we want to back up. In addition, we need to 
inform the tool about the destination directory within the Tencent bucket where 
we want to make the backup copies of the source files. An example of what the 
`variables` file looks like is provided by `dataset-backup-tool/config/variables.dist` 
file.

## Procedure

On a developer environment, we will use `docker-compose`. On a production
environment (CNGB backup server), we will use the script directly for now. In
the examples below, we use `/app/scripts/sync_files.sh`, but it works exactly
the same way for the other script, `/app/scripts/delete_files.sh`.

Using the default values provided in `variables.dist` for the `variables` file,
we will see the following output:
```
$ pwd
<path to>/gigadb-website/gigadb/app/tools/dataset-backup-tool
$ docker-compose run --rm backup_tool /app/scripts/sync_files.sh
Creating dataset-backup-tool_backup_tool_run ... done
2021/11/15 13:41:59 NOTICE: readme_dataset.txt: Not copying as --dry-run
2021/11/15 13:41:59 NOTICE: test.csv: Not copying as --dry-run
2021/11/15 13:41:59 NOTICE: test.tsv: Not copying as --dry-run
```

The reason you see `Not copying as --dry-run` is because the --dry-run mode is
active by default. When confident the output shows what you want to happen, you
can enable the `verbose` mode to proceed for real:
```
$ docker-compose run --rm backup_tool /app/scripts/sync_files.sh --verbose
Creating dataset-backup-tool_backup_tool_run ... done
2021/11/15 13:45:14 INFO  : S3 bucket bucket1-1306096270 path cngbdb/giga/gigadb/: Waiting for checks to finish
2021/11/15 13:45:14 INFO  : S3 bucket bucket1-1306096270 path cngbdb/giga/gigadb/: Waiting for transfers to finish
2021/11/15 13:45:15 INFO  : test.csv: Copied (new)
2021/11/15 13:45:15 INFO  : readme_dataset.txt: Copied (new)
2021/11/15 13:45:21 INFO  : test.tsv: Copied (new)
2021/11/15 13:45:21 INFO  : Waiting for deletions to finish
2021/11/15 13:45:21 INFO  : 
Transferred:           929 / 929 Bytes, 100%, 109 Bytes/s, ETA 0s
Errors:                 0
Checks:                 0 / 0, -
Transferred:            3 / 3, 100%
Elapsed time:        8.5s
```

>**Note 1:** using ``-v`` instead of ``--verbose`` is possible.

The deletion script is more interactive as it prompts the user for the file to 
delete and then ask for confirmation:
```
$ docker-compose run --rm backup_tool /app/scripts/delete_files.sh
Creating dataset-backup-tool_backup_tool_run ... done
Enter the path to the file you want to delete (not including /cngbdb/giga/gigadb):
readme_dataset.txt
Are you sure you want to delete /cngbdb/giga/gigadb/readme_dataset.txt? (y/n) y...
2021/11/15 13:48:38 NOTICE: readme_dataset.txt: Not deleting as --dry-run
```

Now use `--verbose` mode to delete a file for real:
```
$ docker-compose run --rm backup_tool /app/scripts/delete_files.sh -v
Creating dataset-backup-tool_backup_tool_run ... done
Enter the path to the file you want to delete (not including /cngbdb/giga/gigadb):
readme_dataset.txt
Are you sure you want to delete /cngbdb/giga/gigadb/readme_dataset.txt? (y/n) y...

2021/11/15 13:49:38 INFO  : Waiting for deletions to finish
2021/11/15 13:49:39 INFO  : readme_dataset.txt: Deleted
```

Check the contents of the bucket on the Tencent Cloud console to confirm that
the file has been deleted.

## Tests

### Set up

If you have not already done so, please execute:
```
$ docker-compose run --rm config
```

This will the variables: `TENCENTCLOUD_SECRET_ID`, `TENCENTCLOUD_SECRET_KEY`, 
`TENCENTCLOUD_APP_ID`. This will pull these 3 GitLab variables into the`.secrets` 
file and a configuration file, `cos.conf` and shell scripts, `create_bucket.sh` 
and `delete_bucket.sh` will be created in the `dataset-backup-tool/config` and 
`dataset-backup-tool/scripts` directories, respectively.

## Tencent coscmd smoke tests

The smoke tests uses the `create_bucket.sh` and `delete_bucket.sh` shell scripts 
for creating and deleting a Tencent bucket at the start and end of the tests. 
The `cos.conf` file is bind mounted in the tool's container service as 
`/root/.cos.conf` and provides configuration for running `coscmd` commands in 
`BackupSmokeCest` functional test class.

There are 3 smoke tests in `tests/functional/BackupSmokeCest` which backup data
files to a `dataset` directory in a Tencent bucket:

* `tryBackupDataset` will upload 3 files from the `tests/_data/dataset1` 
  directory into the `dataset` directory in a Tencent bucket.
* `tryUpdateBackupWithChangedFile` checks that the `coscmd` tool can detect 
  differences between files. This test should only upload `test.csv` from
  `tests/_data/dataset2` into the Tencent `dataset` backup directory since only 
  this csv file is different in the `dataset2` directory compared to the 
  `dataset1` directory.
* `tryUpdateBackupWithDeletedFile` checks that the `--delete` parameter is able
  to synchronise the contents of a source directory with its counterpart 
  directory in a Tencent bucket. The `tests/_data/dataset3` directory is missing
  `test.tsv` so this test checks that the `test.tsv` file in the Tencent bucket 
  `dataset` directory has been deleted.

To run these smoke tests:
```
$ docker-compose run --rm backup_tool ./vendor/bin/codecept run tests/functional/BackupSmokeCest.php
```

## RClone smoke tests

Rclone is the recommended approach for operating the backup workflows.
`gigadb/app/tools/dataset-backup-tool/config/rclone.conf` is the configuration 
file to enable RClone to operate on Tencent Cloud. That configuration is 
generated by the same `generate_config.sh` aforementioned based on the template
`gigadb/app/tools/dataset-backup-tool/config/rclone.conf.dist`.

The setup has its own smoke tests that can be run using this way:
```
$ docker-compose run --rm backup_tool ./vendor/bin/codecept run -g rclone-setup tests/functional
```

For the benefit of the tests, the configuration file is bind-mounted to the 
`backup_tool` container service in`gigadb/app/tools/dataset-backup-tool/docker-compose.yml`
and rclone itself is deployed to the base image in `gigadb/app/tools/dataset-backup-tool/Dockerfile`.

There are smoke tests which check file upload into a Tencent bucket using RClone. 
These functional smoke tests can be run as follows:
```
$ docker-compose run --rm backup_tool ./vendor/bin/codecept run -g rclone-backup
```

---
## Handling file permission issues

In `cngb-gigadb-bak` server, to identify the permission of the files that is 
`not globally readable` in `/data/gigadb/pub/10.5524/` we could use:
```
$ find /data/gigadb/pub/10.5524/ ! -perm -g+r,u+r,o+r
```
To change the files to `globally readable`, we could use:
```
$ find /data/gigadb/pub/10.5524/ ! -perm -g+r,u+r,o+r -exec chmod a+r {} \;
```
The above is the main command to find not globally readable files recursively 
in a directory and fix it.

## Smoke tests for finding and fixing the permissions

### How to run the test:
Change directory to the `dataset-backup-tool`:
```
$ cd gigadb/app/tools/dataset-backup-tool
$ compose install
$ chmod a+x scripts/perm_to_ok.sh scripts/perm_to_not_ok.sh scripts/fix_permission.sh
```

There are 3 smoke tests in `tests/functional/FixPermissionCest.php` which would
identify and fix the permission in a mock directory `tests/_data/10.1234` :
* `listOkFilePermissions` will identify the permission of the `tests/_data/10.1234/100001_101009/100010/perm-ok.txt` which wasd created with `-rw-r--r--`.

* `listNotOkFilePermissions` will identify the permission of the `tests/_data/10.1234/100001_101009/100300/perm-not-ok.txt` which was created with `----------`.

* `changeNotOkFilePermissionToOk` will identify `non globally readable` files in 
`tests/_data/10.1234/` and change it to `globally readable` like this 
`-r--r--r--`.

To run these smoke tests:
```
$ docker-compose run --rm backup_tool ./vendor/bin/codecept run tests/functional/FixPermissionCest.php
```

###  Set up the `cronjob`:
The permission issues could occur regularly, so a regular fixing would be needed.  
To enable the `cronjob` which would start fixing permission at midnight of every 
day:
```
$ cd gigadb/app/tools/dataset-backup-tool
$ crontab < cronjob_fix_permission.txt
$ crontab -l 
0 0 * * * /app/scripts/fix-permissions.sh >> /tmp/permission_cron.log 2>&1
```
