ApCpanelBundle
==============

Easy to use Cpanel API bundle

## Installation

Installation is a quick (I promise!) 7 step process:

1. Download FOSUserBundle using composer
2. Enable the Bundle
3. Create your User class
4. Configure your application's security.yml
5. Configure the FOSUserBundle
6. Import FOSUserBundle routing
7. Update your database schema

### Step 1: Download ApCpanelBundle using composer

Add ApCpanelBundle by running the command:

``` bash
$ php composer.phar require ap/cpanel-bundle 'dev-master'
```


### Step 2: Register the ApCpanelBundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Ap\CpanelBundle(),
    );
}
```

### Step 3: Configure the ApCpanelBundle

Edit your config.yml:

```yml
ap_cpanel:
    domain: yourdomain.com
    whmusername: yourusername
    whmhash: yourhashahahsshshshshdfasdfkjasñdkfasdf....
```

### Example:

``` php
<?php

public function someAction()
{
	$cpanel = $this->container->get('ap_cpanel.api');
    $cpanel->listaccts();  //This function lists all accounts on the server
    $jsonresult = $cpanel->exec(); //use exec to connect to the server
    $result = json_decode($jsonresult, TRUE);
	...
}
```
