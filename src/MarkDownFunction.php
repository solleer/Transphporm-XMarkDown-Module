<?php

namespace TransphpormXMarkDown;
class MarkDownFunction implements \Transphporm\TSSFunction {
    private $filePath;

    public function __construct(\Transphporm\FilePath $filePath) {
        $this->filePath = $filePath;
    }

    public function run(array $args, \DomElement $element) {
        $markdown = $this->getMarkDown($args[0]);
        $type = isset($args[1]) ? $args[1] : 'standard';
        $markdownType = '\\XMarkDown\\' . ucwords($type);

        $XMarkDown = new $markdownType($markdown);
        $document = $XMarkDown->parse();

        return $this->getContent($document);
    }

    private function getContent($document) {
		$newNode = $document->documentElement;
		$result = [];
		if ($newNode->tagName === 'root') {
			foreach ($newNode->childNodes as $node) {
				$result[] = $this->getClonedElement($node);
			}
		}
		return $result;
	}

	private function getClonedElement($node) {
		$clone = $node->cloneNode(true);
		return $clone;
	}

    private function getMarkDown($markdown) {
        if (is_file($this->filePath->getFilePath($markdown)))
            return file_get_contents($this->filePath->getFilePath($markdown));
        else return $markdown;
    }
}
