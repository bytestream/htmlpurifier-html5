<?php

class HTMLPurifier_URIFilter_SafeLink extends HTMLPurifier_URIFilter
{
    /**
     * @type string
     */
    public $name = 'SafeLink';

    /**
     * @type bool
     */
    public $always_load = true;

    /**
     * @type string
     */
    protected $regexp = null;

    /**
     * @param HTMLPurifier_Config $config
     * @return bool
     */
    public function prepare($config)
    {
        $this->regexp = $config->get('URI.SafeLinkRegexp');

        return true;
    }

    /**
     * @param HTMLPurifier_URI $uri
     * @param HTMLPurifier_Config $config
     * @param HTMLPurifier_Context $context
     * @return bool
     */
    public function filter(&$uri, $config, $context)
    {
        // check if the filter should actually trigger
        if (!$context->get('EmbeddedURI', true)) {
            return true;
        }

        $token = $context->get('CurrentToken', true);
        if (! ($token && $token->name == 'link')) {
            return true;
        }

        // check if we actually have some whitelists enabled
        if ($this->regexp === null) {
            return false;
        }

        // actually check the whitelists
        return preg_match($this->regexp, $uri->toString());
    }
}