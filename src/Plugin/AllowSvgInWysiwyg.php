<?php declare(strict_types=1);

namespace Hyva\CmsWysiwyg\Plugin;

use Hyva\CmsWysiwyg\Model\SvgElements;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Framework\DataObject;
use function array_keys as keys;

class AllowSvgInWysiwyg
{
    /**
     * @var SvgElements
     */
    private $svgElements;

    public function __construct(SvgElements $svgElements)
    {
        $this->svgElements = $svgElements;
    }

    public function afterGetConfig(Config $subject, DataObject $result): DataObject
    {
        $settings = $result->getData('settings');

        $extendedSettings = isset($settings['extended_valid_elements'])
            ? $settings['extended_valid_elements'] . ','
            : '';

        // documented setting, but doesn't work on it's own - SVG's are still removed...
        $settings['extended_valid_elements'] = $extendedSettings . implode(',', $this->buildExtendedValidElements());

        // non documented setting, but it works with tinymce4 and tinymce5
        // @see https://stackoverflow.com/a/48884025
        $settings['non_empty_elements'] =
            'td,th,iframe,video,audio,object,script,i,em,span,area,base,basefont,br,' . // default list
            'col,embed,frame,hr,img,input,isindex,link,meta,param,,source,wbr,track,' . // also default list
            implode(',', keys($this->svgElements->getSvgElements()));

        $result->setData('settings', $settings);

        return $result;
    }

    private function buildExtendedValidElements(): array
    {
        foreach ($this->svgElements->getSvgElements() as $element => $attributes) {
            // Ignore the attributes - too often deprecated attributes are used, and they make the string grow large.
            $extend[] = $element . '[*]';
            //$extend[] = $element . '[' . ($attributes === [] ? '*' : implode('|', $attributes)) . ']';
        }
        return $extend;
    }
}
