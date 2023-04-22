# laravel-lighthouse
 Automatically Audit Desktop and Mobile Websites dengan Google Chrome Lighthouse Wrapper for Laravel


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
