The following distributions are only supported for [LTS releases](./intro#lts-releases) up to 3.6.

### Ubuntu 10.04 Lucid

*HHVM 3.3 only*

```
sudo add-apt-repository ppa:ubuntu-toolchain-r/test
wget -O - http://dl.hhvm.com/conf/hhvm.gpg.key | sudo apt-key add -
echo deb http://dl.hhvm.com/ubuntu lucid main | sudo tee /etc/apt/sources.list.d/hhvm.list
sudo apt-get update
sudo apt-get install gcc-4.8 g++-4.8 gcc-4.8-base
sudo apt-get install hhvm
```

### Ubuntu 12.04 Precise

*HHVM 3.6 only*

```
# If this command is not found then do this: sudo apt-get install python-software-properties
sudo add-apt-repository ppa:mapnik/boost
sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
echo deb http://dl.hhvm.com/ubuntu precise main | sudo tee /etc/apt/sources.list.d/hhvm.list
sudo apt-get update
sudo apt-get install hhvm
```
```
# If you are getting segfaults
sudo apt-get install hhvm-dbg
```

Don't forget to Install Boost 1.49 on Ubuntu 12.04. See [Building and Installing HHVM on Ubuntu 12.04](https://github.com/facebook/hhvm/wiki/Building-and-installing-HHVM-on-Ubuntu-12.04#installing-boost-149) for details.

### Mint 16 Preta

*HHVM 3.6 only*

```
sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
echo deb http://dl.hhvm.com/mint petra main | sudo tee /etc/apt/sources.list.d/hhvm.list
sudo apt-get update
sudo apt-get install hhvm
```
```
# If you are getting segfaults
sudo apt-get install hhvm-dbg
```

If this repo is slow for you, choose a different [[Mirror]].

If you get the following error when trying to run hhvm:

```
hhvm: error while loading shared libraries: libboost_program_options.so.1.49.0: cannot open shared object file: No such file or directory
```

you may be able to fix it by simply installing the required packages (hhvm package incorrectly installs libboost 1.53):

```
sudo apt-get install libboost-filesystem1.49.0 libboost-program-options1.49.0 libboost-regex1.49.0 libboost-thread1.49.0
```
