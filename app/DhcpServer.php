<?php

namespace App;

use Storage;

class DhcpServer
{
    /**
     * The contents of the config file
     * @var string
     */
    public $config_file;

    /**
     * The name of the container running dhcp
     * @var string
     */
    public $container_name;

    /**
     * The contents of the leases file
     * @var string
     */
    public $leases_file;

    /**
     * The number of leases in the leases file
     * @var integer
     */
    public $number_of_leases;

    /**
     * A list of service/config files that will load when dhcp starts
     * @var array
     */
    public $service_files;

    /**
     * A list of files in the tftp directory
     * @var array
     */
    public $tftp_files;

    /**
     * A list of files in the imports directory
     * @var array
     */
    public $files_for_import;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->config_file = $this->getConfigFile();
        $this->container_name = $this->getContainerName();
        $this->leases_file = $this->getLeasesFile();
        $this->number_of_leases = $this->getNumberOfLeases();
        $this->service_files = $this->getServiceFiles();
        $this->tftp_files = $this->getTftpFiles();
        $this->files_for_import = $this->getFilesForImport();
    }

    /**
     * @return string The name of the dhcp container
     */
    protected function getContainerName()
    {
        return config('gang.dhcp_container_name');
    }

    /**
     * @return string The file contents
     */
    protected function getConfigFile()
    {
        return Storage::disk('public')->get(config('gang.dhcp_config_file_location'));
    }

    /**
     * @return array The list of files
     */
    protected function getFilesForImport()
    {
        return Storage::disk('public')->files(config('gang.files_for_import_location'));
    }

    /**
     * @return string The file contents
     */
    protected function getLeasesFile()
    {
        return Storage::disk('public')->get(config('gang.dhcp_leases_file_location'));
    }

    /**
     * Count the lines in the leases file
     * @return integer Number of lines in the leases file
     */
    protected function getNumberOfLeases()
    {
        return count(explode("\n", $this->getLeasesFile())) - 1;
    }

    /**
     * @return array The list of files
     */
    protected function getServiceFiles()
    {
        return Storage::disk('public')->files(config('gang.dhcp_service_files_location'));
    }

    /**
     * @return array The list of files
     */
    protected function getTftpFiles()
    {
        return Storage::disk('public')->allFiles(config('gang.dhcp_tftp_files_location'));
    }
}
