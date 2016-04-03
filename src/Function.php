<?php

namespace TransphpormXMarkDown;
class Function implements \Transphporm\TSSFunction {
    private $baseDir;

    public function __construct(&$baseDir) {
        $this->baseDir = &$baseDir;
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
        if (is_file($this->baseDir . $markdown)) {
            return file_get_contents($this->baseDir . $markdown);
        }
        else return $markdown;
    }
}
