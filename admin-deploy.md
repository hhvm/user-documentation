# Deploying The Site (for admins only)

> If you have installed Docker and AWS Elastic Beanstalk, you will probably be starting from the [general starting point](#general-starting-point).

## Only Do This Once

1. You have probably already done this, but make sure you have `git` installed and you have set up your email and name configuration. Also make sure your server has a working IPv6.

   ```
   $ git config --global user.name "Your GitHub Name" # Real name, not username.
   $ git config --global user.email "Your GitHub Email"

   $ curl -6 http://www.google.com
   ```


2. Install [Docker](https://www.docker.com/). 
   - [Linux](http://docs.docker.com/linux/step_one/)
   - [Mac](http://docs.docker.com/mac/step_one/)

3. **Linux Only**: Add yourself to the docker group.

   ```
   $ sudo usermod -aG docker your-user-name
   ```

3. **Linux Only**: After you add yourself to the group, make sure you **logout** to ensure that the docker service is running, or you might get something like 

   ```
    Cannot connect to the Docker daemon. Is 'docker daemon' running on this host?
   ```

4. Once Docker is installed, login to docker

   ```
   $ docker login # enter your docker username, password and email
   ```

5. Login in to AWS and create an access key (click on your name in the top
   right, 'security credentials', 'Users', '<your user name>', 'create new access key'.

6. Install the AWS EB (Elastic Beanstalk) tools:

   ```
   # On Ubuntu
   $ sudo apt-get install python-dev
   $ sudo apt-get install python-pip
   $ sudo pip install awsebcli
   ```

   ```
   # On Mac OS X 10.7+
   $  curl -s https://s3.amazonaws.com/elasticbeanstalk-cli-resources/install-ebcli.py | python
   ... or ...
   $ brew install awsebcli
   ```

   Other distros, you can check here: http://docs.aws.amazon.com/elasticbeanstalk/latest/dg/eb-cli3-install.html

7. Configure your `hhvm/user-documentation` checkout for pushing to AWS - you will be prompted for your access keys, region (`us-west-2`) and application. Select the `hack-hhvm-docs` application.

   ```
   # From your user-documentation checkout directory
   $ eb init
   ```

## General Starting Point

1. Rebase your repo to get the lastest and greatest changes; do a full composer rebuild... e.g., just in case new classes were added for testing.

   ```
   # or another branch name instead of origin/master, if applicable
   $ git fetch && git rebase origin/master
   $ hhvm composer.phar install
   ```

2. To save you time, you may want to run the PHPUnit test suite before starting the deploy, just in case there is a problem that needs fixing.

   ```
   $ hhvm bin/build.php
   $ hhvm vendor/bin/phpunit
   ```

3. Assuming there are no issues with the build or tests, from your checkout, push to staging on AWS with:

   ```
   $ bin/deploy-to-staging.sh
   ```

4. Once the deploy script is finished and you have successfully deployed, do a fetch and merge via `git pull` and then push the AWS commit to the `user-documentation` repo. **Do not** `rebase`, so that the history before that commit keeps on matching what was actually pushed.

   ```
   $ git pull
   $ git push
   ```

5. Create a changelog, ideally piping it to a markdown file via [gist](https://github.com/defunkt/gist)

   ```
   $ bin/changelog.sh | gist --type md
   ```

6. Test the staging site at http://staging.docs.hhvm.com

7. Swap staging and production

  ```
  $ eb swap
  ```

  Now the docs will be at http://docs.hhvm.com
