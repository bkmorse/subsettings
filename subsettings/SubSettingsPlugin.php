<?php
namespace Craft;

class SubSettingsPlugin extends BasePlugin
{
    // =========================================================================
    // PLUGIN INFO
    // =========================================================================

    public function getName()
    {
        return Craft::t('CP Sub Settings');
    }

    public function getVersion()
    {
        return '0.0.1';
    }

    public function getSchemaVersion()
    {
        return '0.0.1';
    }

    public function getDeveloper()
    {
        return 'Brad Morse';
    }

    public function getDeveloperUrl()
    {
        return 'http://bkmorse.com';
    }

    public function getPluginUrl()
    {
        return '';
    }

    public function getDocumentationUrl()
    {
        // return $this->getPluginUrl() . '/blob/master/README.md';
        return '';
    }

    public function getReleaseFeedUrl()
    {
        return '';
    }

    public function onBeforeInstall()
    {   
        // Craft 2.3.2615 getFieldsForElementsQuery()
        if (version_compare(craft()->getVersion() . '.' . craft()->getBuild(), '2.3.2615', '<')) {
            throw new Exception($this->getName() . ' requires Craft CMS 2.3.2615+ in order to run.');
        }
    }


    // =========================================================================
    // HOOKS
    // =========================================================================


    public function modifyCpNav(&$nav)
    {
        if (!craft()->userSession->isAdmin())
            return false;

        $cpvariable = new CpVariable;
        $category_settings = $cpvariable->settings();

        foreach($category_settings as $ckey => $cvalue)
        {
            foreach($cvalue as $key => $value)
            {
                if ($ckey != "Plugins")
                    $nav[$key] = array('label' => $value['label'], 'url' => 'settings/'.$key);
            }
        }
    }    
}
