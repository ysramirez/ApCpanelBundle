ApCpanelBundle
==============

Easy to use Cpanel API bundle

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
    whmhash: yourhashahahsshshshshdfasdfkjasadfasdf....
```

### Example:

``` php
<?php

public function someAction()
{
//..    
	$cpanel = $this->container->get('ap_cpanel.api');
	
    $accountsJson = $cpanel->listaccts()->exec();
    
    $result   = json_decode($accountsJson, TRUE);
//..    
}
```
