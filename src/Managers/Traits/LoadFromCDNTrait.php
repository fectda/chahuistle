<?php

namespace Cltvo\Chahuistle\Managers\Traits;


trait LoadFromCDNTrait
{
    /**
     * get resource from  cdn or local storage
     * @param  string $base_path resourse storage base path
     * @return string            source
     */
    public function getSource($base_path)
    {
        if (isset($this->cdn_url) && filter_var($this->cdn_url , FILTER_VALIDATE_URL) ) {
            $cdn_response = wp_remote_get( $this->cdn_url );
            if( !is_wp_error( $cdn_response ) && wp_remote_retrieve_response_code($cdn_response) == '200' ) {
                return $this->cdn_url;
            }
        }

        return $base_path.$this->getFilename();
    }

}
