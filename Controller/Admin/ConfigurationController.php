<?php

namespace GoogleShopping\Controller\Admin;

use GoogleShopping\Event\GoogleShoppingEvents;
use GoogleShopping\Form\ApiConfigurationForm;
use GoogleShopping\Form\MerchantConfigurationForm;
use GoogleShopping\GoogleShopping;
use GoogleShopping\Handler\GoogleShoppingHandler;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;

class ConfigurationController extends BaseAdminController
{
    public function viewAllAction($params = array())
    {
        if (null !== $response = $this->checkAuth(array(AdminResources::MODULE), 'GoogleShopping', AccessManager::VIEW)) {
            return $response;
        }

        return $this->render(
            "module-configure",
            array(
                "module_code" => 'GoogleShopping',
                "sync_secret" => GoogleShopping::getConfigValue('sync_secret')
            )
        );
    }


    public function saveApiConfiguration()
    {
        if (null !== $response = $this->checkAuth(array(AdminResources::MODULE), array('GoogleShopping'), AccessManager::CREATE)) {
            return $response;
        }

        $message = null;

        $form = new ApiConfigurationForm($this->getRequest());

        try {
            $formData = $this->validateForm($form)->getData();

            foreach ($formData as $name => $value) {
                if ($name === "success_url" || $name === "error_message") {
                    continue;
                }
                GoogleShopping::setConfigValue($name, $value);
            }

            return $this->generateRedirect('/admin/module/GoogleShopping');

        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        $this->setupFormErrorContext(
            $this->getTranslator()->trans("GoogleShopping configuration", [], GoogleShopping::DOMAIN_NAME),
            $message,
            $form,
            $e
        );


        return $this->render('module-configure', array('module_code' => 'GoogleShopping'));
    }

    public function saveMerchantConfiguration()
    {
        if (null !== $response = $this->checkAuth(array(AdminResources::MODULE), array('GoogleShopping'), AccessManager::CREATE)) {
            return $response;
        }

        $message = null;

        $form = new MerchantConfigurationForm($this->getRequest());

        try {
            $formData = $this->validateForm($form)->getData();

            foreach ($formData as $name => $value) {
                if ($name === "success_url" || $name === "error_message") {
                    continue;
                }
                GoogleShopping::setConfigValue($name, $value);
            }

            return $this->generateRedirect('/admin/module/GoogleShopping');

        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        $this->setupFormErrorContext(
            $this->getTranslator()->trans("GoogleShopping configuration", [], GoogleShopping::DOMAIN_NAME),
            $message,
            $form,
            $e
        );

        return $this->render('module-configure', array('module_code' => 'GoogleShopping'));
    }

    public function syncCatalog($secret = null)
    {
        if (null !== $secret && GoogleShopping::getConfigValue("sync_secret") !== $secret) {
            return null;
        } elseif (null !== $response = $this->checkAuth(array(AdminResources::MODULE), array('GoogleShopping'), AccessManager::CREATE)) {
            return $response;
        }

        try {
            $this->getDispatcher()->dispatch(GoogleShoppingEvents::GOOGLE_SYNC_CATALOG);

            return $this->generateRedirectFromRoute(
                "admin.module.configure",
                array(),
                array(
                    'module_code' => 'GoogleShopping',
                    'current_tab' => 'management',
                    'google_alert' => "success",
                    'google_message' =>
                        $this->getTranslator()->trans(
                            "Catalog sync with success",
                            [],
                            GoogleShopping::DOMAIN_NAME
                        )
                )
            );
        } catch (\Exception $e) {
            return $this->generateRedirectFromRoute(
                "admin.module.configure",
                array(),
                array(
                    'module_code' => 'GoogleShopping',
                    'current_tab' => 'management',
                    'google_alert' => "error",
                    'google_message' =>
                        $this->getTranslator()->trans(
                            "Error on Google Shopping synchonisation : %message",
                            ['message' => $e->getMessage()],
                            GoogleShopping::DOMAIN_NAME
                        )
                )
            );
        }
    }
}
