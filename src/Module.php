<?php

namespace TransphpormXMarkDown;
class Module implements \Transphporm\Module {
    public function load(\Transphporm\Config $config) {
		$functionSet = $config->getFunctionSet();
		$filePath = $config->getFilePath();

        $functionSet->addFunction('markdown', new MarkDownFunction($filePath));
    }
}
