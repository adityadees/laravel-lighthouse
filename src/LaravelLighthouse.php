<?php

declare(strict_types=1);

namespace AdityaDees\LaravelLighthouse;

use AdityaDees\LaravelLighthouse\Exceptions\ErrorException;
use Exception;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * LaravelLighthouse
 *
 * @author Aditya Dharmawan Saputra @adityadees
 *
 */


class LaravelLighthouse
{
    private int $timeout;
    public function __construct()
    {
        $this->timeout = config('laravel-lighthouse.timeout');
    }

    private function setComandShell(string $url): string
    {

        if (empty($url))
            throw ErrorException::url();


        $node = config('laravel-lighthouse.node');

        if (empty($node))
            throw ErrorException::pathNode();

        $lighthouse = config('laravel-lighthouse.lighthouse');

        if (empty($lighthouse))
            throw ErrorException::pathLighthouse();

        $array = [
            $node,
            $lighthouse,
            $url,
        ];

        return implode(' ', $array);
    }

    private function setDirectoryOutput(string $device): string
    {
        if (empty($device))
            throw ErrorException::device($device);

        $output = config('laravel-lighthouse.output');

        if (empty($output))
            throw ErrorException::pathOutput();


        $basePath = $output . '/' . $device;
        if (!file_exists($basePath)) {
            mkdir($basePath, 0755, true);
        }

        return $basePath;
    }


    private function setNameOutput(string $url): string
    {
        if (empty($url))
            throw  ErrorException::url();

        $parseUrl = parse_url($url);

        if (!isset($parseUrl['host']))
            throw  ErrorException::host();

        if (isset($parseUrl['path'])) {
            $urlName = str_replace('.', '-', $parseUrl['host']) . '-' . trim(str_replace('/', '-', $parseUrl['path']), '/');
        } else {
            $urlName = str_replace('.', '-', $parseUrl['host']);
        }

        return $urlName;
    }

    private function desktop(string $url): bool
    {
        $basePath =  $this->setDirectoryOutput('desktop');
        $outputName = $this->setNameOutput($url);
        $filePath = $basePath . '/' . $outputName . '.html';
        $process = Process::fromShellCommandline($this->setComandShell($url) . ' --chrome-flags="--headless --no-sandbox --disable-gpu" --preset=desktop --output html --output json --output-path ' . $filePath);
        $process->setTimeout($this->timeout);
        $process->run();

        if (!$process->isSuccessful())
            throw new ProcessFailedException($process);

        return true;
    }

    private function mobile(string $url): bool
    {
        $basePath =  $this->setDirectoryOutput('mobile');
        $outputName = $this->setNameOutput($url);
        $filePath = $basePath . '/' . $outputName . '.html';
        $process = Process::fromShellCommandline($this->setComandShell($url) . ' --chrome-flags="--headless --no-sandbox --disable-gpu" --output html --output json --output-path ' . $filePath);
        $process->setTimeout($this->timeout);
        $process->run();

        if (!$process->isSuccessful())
            throw new ProcessFailedException($process);

        return true;
    }


    /**
     * @param string $url | You can use url from config as global url or pass it to paramater
     * @param string $flag | You can use flag from config as global flag or pass it to paramater
     * @param string $device | You can use device from config as global device or pass it to paramater
     * @example selfConfiguration( $url = 'https://example.com', $flag = '--chrome-flags="--headless --no-sandbox --disable-gpu" --preset=desktop --output html --output json --output-path ' . base_path() . '/public/laravel-lighthouse/desktop/result.html', $device = 'desktop' )
     */
    public function selfConfiguration($url = null, $flag = null, $device = null): bool
    {
        $url =  !empty($url) ? $url : config('laravel-lighthouse.url');
        if (empty($device)) {
            $mobileFlag = config('laravel-lighthouse.flag.mobile');
            $processMobile = Process::fromShellCommandline($this->setComandShell($url) . ' ' . $mobileFlag);
            $processMobile->setTimeout($this->timeout);
            $processMobile->run();

            if (!$processMobile->isSuccessful())
                throw new ProcessFailedException($processMobile);


            $desktopFlag = config('laravel-lighthouse.flag.desktop');
            $processDesktop = Process::fromShellCommandline($this->setComandShell($url) . ' ' . $desktopFlag);
            $processDesktop->setTimeout($this->timeout);
            $processDesktop->run();

            if (!$processDesktop->isSuccessful())
                throw new ProcessFailedException($processDesktop);


            return true;
        } else {
            if ($device == 'desktop') {
                $flag =  !empty($flag) ? $flag : config('laravel-lighthouse.flag.device');
            } else if ($device == 'mobile') {
                $flag =  !empty($flag) ? $flag : config('laravel-lighthouse.flag.device');
            } else {
                throw  ErrorException::device($device);
            }

            $process = Process::fromShellCommandline($this->setComandShell($url) . ' ' . $flag);
            $process->setTimeout($this->timeout);
            $process->run();


            if (!$process->isSuccessful())
                throw new ProcessFailedException($process);

            return true;
        }
    }


    /**
     * @param string $url | You can use url from config as global url or pass it to paramater
     * @param string $device | You can use device from config as global device or pass it to paramater
     * @example selfConfiguration( $url = 'https://example.com', $device = 'desktop' )
     */
    public function run($url = null, $device = null): bool
    {
        $url =  !empty($url) ? $url : config('laravel-lighthouse.url');

        if (empty($device)) {
            $mobile = $this->mobile($url);
            $desktop = $this->desktop($url);

            if ($mobile && $desktop) {
                return true;
            } else {
                return false;
            }
        } else if ($device == 'mobile') {
            return $this->mobile($url);
        } else if ($device == 'desktop') {
            return $this->desktop($url);
        } else {
            throw  ErrorException::device($device);
        }
    }
}
