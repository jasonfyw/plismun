# Getting Started

This document outlines the steps to access the production server through FTP and begin contributing to and maintaining the project.

## Getting project files

Version control is done through Github but config files (containing passwords and keys) are not included in the repository for obvious reasons. Instead, they are hosted directly on the production server. As a result, we need to get files from both Github and the server.

First, clone the repository. Git needs to be installed before you do this.

```
$ git clone https://github.com/jasonfyw/plismun
```

To get the config files directly off the server, there are two ways of going about it – choose whichever is easiest for you.

### Option 1: Downloading all and merging

From the Hostinger dashboard for PLISMUN, navigate to `Files > Backups` and generate a new backup (if one has already been made in the past 24 hours, download all files from the most recent backup).

Uncompress the downloaded file and copy the contents of the `public_html` directory into the cloned repository. The easiest way to do this is through the command line. Depending on the directories of the downloaded folder and the repository, execute the following:

```
$ cp -a ~/Downloads/u507644240/public_html/. ~/path_to_repository_parent/plismun
```

Ensure that `/.` follows the source directory. 

### Option 2: Download config files from online file manager

From the Hostinger dashboard, go to the online file manager at `Files > File Manager`

Navigate to the `public_html` directory. Then, select the following files and download them onto your machine:

* `application_mail_config.php`
* `config.php`
* `contact_mail_config.php`

Then, move them into the main repository.


## Sync local files to server through FTP

I use VS Code for my editor and a number of extensions are available providing FTP syncing, such as `ftp-sync` and `ftp-simple`. I personally use `ftp-kr`.

Install whichever extension and, with the repository open in VS Code, initialise the extension for this particular repository. You can do this by opening the Command Palette by hitting `Cmd + Shift + P` and typing `init` to find the initialising function of the extension. Run that and it should make a config file in the `.vscode` directory.

The config file requires credentials to access the FTP server of the hosting service. In the Hostinger dashboard, navigate to `Files > FTP Accounts`. Create a new FTP account (leave the directory to public_html) and copy the relevant information into the config file (including host, username, password and port).

For reference, the following is the config file I used for the ftp-kr extension (username and password redacted):

```json
{
    "host": "ftp.plismun.com",
    "username": "USERNAME",
    "password": "PASSWORD",
    "remotePath": "/",
    "protocol": "ftp",
    "port": 21,
    "fileNameEncoding": "utf8",
    "autoUpload": true,
    "autoDelete": false,
    "autoDownload": false,
    "ignore": [
        ".git",
        "/.vscode"
    ]
}
```

If you want changes to be uploaded upon saving, make sure to set the `autoUpload` option to `true` (the option is called `uploadOnSave` in the ftp-sync extension). Otherwise, it's possible to manually upload a file to FTP by right clicking on the file and clicking the upload option.

## Making changes

Any changes made locally will be reflected on the live production server. As a result, it is recommended to make small, iterative changes to avoid catastrophic failure.

Also, make sure to commit any changes that don't break the website to git (ideally with a descriptive commit message as well – check out the [commit history](https://github.com/jasonfyw/plismun/commits/master) to get an idea of this).

### Committing to Github

Committing changes is done in three steps.

First, stage the files with changes that you want to commit:

```
$ git add some_file.php
```

Secondly, commit the staged changes along with a message:

```
$ git commit -m "some message describing the changes"
```

Lastly, push the changes to Github so that it can be saved to the publically available repository:

```
$ git push
```

Alternatively, use the source control UI built-into editors like VS Code.

### Collaborating with others

A disadvantage of directly uploading to the FTP server is that it can result in code conflicts when working with others. The local version will always overwrite the version on the server so different people may have different local versions of the project.

One way to avoid this is to communicate changes to anyone involved, to not work on the same file at once and to **commit any and all changes made**. This way, you can `git pull` and remain up to date with other machines.