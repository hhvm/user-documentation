# Deploying The Site (for admins only)

> If you have installed Docker and AWS Elastic Beanstalk, you will probably be starting from step 8.

1. You have probably already done this, but make sure you have `git` installed and you have set up your email and name configuration. Also make sure your server has a working IPv6.

   ```
   $ git config --global user.name "Your GitHub Name" # Real name, not username.
   $ git config --global user.email "Your GitHub Email"

   $ curl -6 http://www.google.com
   ```


2. Install [Docker](http://docs.docker.com/linux/step_one/). If you are running Mac, [here](http://docs.docker.com/mac/step_one/) are those instructions. Add yourself to the docker group.

   ```
   $ sudo usermod -aG docker your-user-name
   ```

3. After you add yourself to the group, make sure you **logout** to ensure that the docker service is running, or you might get something like 

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
   ```

   Other distros, you can check here: http://docs.aws.amazon.com/elasticbeanstalk/latest/dg/eb-cli3-install.html

7. Configure your `hhvm/user-documentation` checkout for pushing to AWS - you will be prompted for your access keys, region (`us-west-2`) and application. Select the `hack-hhvm-docs` application.

   ```
   # From your user-documentation checkout directory
   $ eb init
   ```

8. After making one or more updates, you will want to push to AWS. From your checkout, push to staging with:

   ```
   $ bin/deploy-to-staging.sh
   ```

   **NOTE**: This is first step you will need to do for future pushes from the same checkout.

9. Once the deploy script is finished and you have successfully deployed, push the AWS commit to the `user-documentation` repo

   ```
   $ git push
   ```

10. Test the staging site at http://staging.docs.hhvm.com

11. Swap staging and production

  ```
  $ eb swap
  ```

  Now the docs will be at http://beta.docs.hhvm.com
