# laravel-lighthouse
 Automatically Audit Desktop and Mobile Websites dengan Google Chrome Lighthouse Wrapper for Laravel

run
`composer require adityadees/laravel-lighthouse`
then 
`php artisan vendor:publish --tag=laravel-lighthouse`



Before use this package you need define variable on `config/laravel-lighthouse.php` as global config

To use it you can run
```php
# $url = optional, you can using global config or override it to this variable
# $device = optional, if blank will scan both, mobile and desktop mode
$lighouse = (new LaravelLighthouse())->run($url,$device);

// using default config option
$lighouse = (new LaravelLighthouse())->run();

// run both mobile and desktop
$lighouse = (new LaravelLighthouse())->run('https://adityadees.com');

// run only mobile
$lighouse = (new LaravelLighthouse())->run('https://adityadees.com', 'mobile');

// run only desktop
$lighouse = (new LaravelLighthouse())->run('https://adityadees.com', 'desktop');

// run only mobile with global url defined on config
$lighouse = (new LaravelLighthouse())->run('', 'mobile');

// run only desktop with global url defined on config
$lighouse = (new LaravelLighthouse())->run('', 'desktop');
```

or you can use your own custom configuration like this

```php
# $url = optional, you can using global config or override it to this variable
# $flag = optional, you can use the config or define it on here
# $device = optional, if blank will scan both, mobile and desktop mode
$lighouse = (new LaravelLighthouse())->selfConfiguration($url,$flag,$device);


// using self configuration with config as default
$lighouse = (new LaravelLighthouse())->selfConfiguration('https://adityadees.com');

// run self configuration with override url, flag and both device
$lighouse = (new LaravelLighthouse())->selfConfiguration('https://adityadees.com', '--chrome-flags="--headless --no-sandbox --disable-gpu" --output html --output json --output-path ' . base_path() . '/public/laravel-lighthouse/mobile/result.html');

// run self configuration with override url, flag and device to mobile mode
$lighouse = (new LaravelLighthouse())->selfConfiguration('https://adityadees.com', '--chrome-flags="--headless --no-sandbox --disable-gpu" --output html --output json --output-path ' . base_path() . '/public/laravel-lighthouse/mobile/result.html', 'mobile');

// run self configuration with override url, flag and device to dekstop mode
$lighouse = (new LaravelLighthouse())->selfConfiguration('https://adityadees.com', '--chrome-flags="--headless --no-sandbox --disable-gpu" --preset=desktop --output html --output json --output-path ' . base_path() . '/public/laravel-lighthouse/desktop/result.html', 'desktop');

```

for more information about the flag you can visit
https://github.com/GoogleChrome/lighthouse


if you following the configuration example the results should be like this
- Inside folder `public` you can see the results `.html` and `.json`

https://github.com/adityadees/laravel-lighthouse/tree/docs/example-results/laravel-lighthouse

<img width="271" alt="image" src="https://user-images.githubusercontent.com/37553901/233770747-1de6da10-a59b-4ecc-bffd-7fff4af68a5a.png">

if you open the `.html` you can see the results like this

Desktop

![image](https://user-images.githubusercontent.com/37553901/233770848-8e45ad77-5b37-4363-96bb-42cec52cdb8a.png)


Mobile
![image](https://user-images.githubusercontent.com/37553901/233770874-5a7d8740-e09a-43d6-8a4f-532023f0c603.png)
