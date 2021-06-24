<?php declare(strict_types=1);

namespace Hyva\CmsWysiwyg\Plugin;

use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Framework\DataObject;
use function array_keys as keys;
use function array_map as map;
use function array_merge as merge;
use function array_unique as unique;

class AllowSvgInWysiwyg
{
    const CORE = 'core';
    const STYLE = 'style';
    const PRESENTATION = 'presentation';
    const FILTER_PRIMITIVE = 'filterPrimitive';
    const TRANSFER_FUNCTION = 'transferFunction';
    const ANIMATION_TARGET_ELEMENT = 'animationTargetElement';
    const ANIMATION_ATTRIBUTE_TARGET = 'animationAttributeTarget';
    const ANIMATION_TIMING = 'animationTiming';
    const ANIMATION_VALUE = 'animationValue';
    const ANIMATION_ADDITION = 'animationAddition';
    const ANIMATION_EVENT = 'animationEvent';
    const DOCUMENT_EVENT = 'documentEvent';
    const DOCUMENT_ELEMENT_EVENT = 'documentElementEvent';
    const GLOBAL_EVENT = 'globalEvent';
    const GRAPHICAL_EVENT = 'graphicalEvent';
    const ARIA = 'aria';

    private const ATTRS = [
        self::CORE                       => [
            'id',
            'lang',
            'tabindex',
            'xml:base',
            'xml:lang',
            'xml:space',
        ],
        self::STYLE                      => ['class', 'style'],
        self::PRESENTATION               => [
            'alignment-baseline',
            'baseline-shift',
            'clip',
            'clip-path',
            'clip-rule',
            'color',
            'color-interpolation',
            'color-interpolation-filters',
            'color-profile',
            'color-rendering',
            'cursor',
            'direction',
            'display',
            'dominant-baseline',
            'enable-background',
            'fill',
            'fill-opacity',
            'fill-rule',
            'filter',
            'flood-color',
            'flood-opacity',
            'font-family',
            'font-size',
            'font-size-adjust',
            'font-stretch',
            'font-style',
            'font-variant',
            'font-weight',
            'glyph-orientation-horizontal',
            'glyph-orientation-vertical',
            'image-rendering',
            'kerning',
            'letter-spacing',
            'lighting-color',
            'marker-end',
            'marker-mid',
            'marker-start',
            'mask',
            'opacity',
            'overflow',
            'pointer-events',
            'shape-rendering',
            'stop-color',
            'stop-opacity',
            'stroke',
            'stroke-dasharray',
            'stroke-dashoffset',
            'stroke-linecap',
            'stroke-linejoin',
            'stroke-miterlimit',
            'stroke-opacity',
            'stroke-width',
            'text-anchor',
            'text-decoration',
            'text-rendering',
            'transform',
            'transform-origin',
            'unicode-bidi',
            'vector-effect',
            'visibility',
            'word-spacing',
            'writing-mode',
        ],
        self::FILTER_PRIMITIVE           => [
            'height',
            'result',
            'width',
            'x',
            'y',
        ],
        self::TRANSFER_FUNCTION          => [
            'type',
            'tableValues',
            'slope',
            'intercept',
            'amplitude',
            'exponent',
            'offset',
        ],
        self::ANIMATION_TARGET_ELEMENT   => ['href'],
        self::ANIMATION_ATTRIBUTE_TARGET => ['attributeType', 'attributeName'],
        self::ANIMATION_TIMING           => [
            'begin',
            'dur',
            'end',
            'min',
            'max',
            'restart',
            'repeatCount',
            'repeatDur',
            'fill',
        ],
        self::ANIMATION_VALUE            => [
            'calcMode',
            'values',
            'keyTimes',
            'keySplines',
            'from',
            'to',
            'by',
            'autoReverse',
            'accelerate',
            'decelerate',
        ],
        self::ANIMATION_ADDITION         => ['additive', 'accumulate'],
        self::ANIMATION_EVENT            => ['onbegin', 'onend', 'onrepeat'],
        self::DOCUMENT_EVENT             => ['onabort', 'onerror', 'onresize', 'onscroll', 'onunload'],
        self::DOCUMENT_ELEMENT_EVENT     => ['oncopy', 'oncut', 'onpaste'],
        self::GLOBAL_EVENT               => [
            'oncancel',
            'oncanplay',
            'oncanplaythrough',
            'onchange',
            'onclick',
            'onclose',
            'oncuechange',
            'ondblclick',
            'ondrag',
            'ondragend',
            'ondragenter',
            'ondragexit',
            'ondragleave',
            'ondragover',
            'ondragstart',
            'ondrop',
            'ondurationchange',
            'onemptied',
            'onended',
            'onerror',
            'onfocus',
            'oninput',
            'oninvalid',
            'onkeydown',
            'onkeypress',
            'onkeyup',
            'onload',
            'onloadeddata',
            'onloadedmetadata',
            'onloadstart',
            'onmousedown',
            'onmouseenter',
            'onmouseleave',
            'onmousemove',
            'onmouseout',
            'onmouseover',
            'onmouseup',
            'onmousewheel',
            'onpause',
            'onplay',
            'onplaying',
            'onprogress',
            'onratechange',
            'onreset',
            'onresize',
            'onscroll',
            'onseeked',
            'onseeking',
            'onselect',
            'onshow',
            'onstalled',
            'onsubmit',
            'onsuspend',
            'ontimeupdate',
            'ontoggle',
            'onvolumechange',
            'onwaiting',
        ],
        self::GRAPHICAL_EVENT            => ['onactivate', 'onfocusin', 'onfocusout'],
        self::ARIA                       => [
            'aria-activedescendant',
            'aria-atomic',
            'aria-autocomplete',
            'aria-busy',
            'aria-checked',
            'aria-colcount',
            'aria-colindex',
            'aria-colspan',
            'aria-controls',
            'aria-current',
            'aria-describedby',
            'aria-details',
            'aria-disabled',
            'aria-dropeffect',
            'aria-errormessage',
            'aria-expanded',
            'aria-flowto',
            'aria-grabbed',
            'aria-haspopup',
            'aria-hidden',
            'aria-invalid',
            'aria-keyshortcuts',
            'aria-label',
            'aria-labelledby',
            'aria-level',
            'aria-live',
            'aria-modal',
            'aria-multiline',
            'aria-multiselectable',
            'aria-orientation',
            'aria-owns',
            'aria-placeholder',
            'aria-posinset',
            'aria-pressed',
            'aria-readonly',
            'aria-relevant',
            'aria-required',
            'aria-roledescription',
            'aria-rowcount',
            'aria-rowindex',
            'aria-rowspan',
            'aria-selected',
            'aria-setsize',
            'aria-sort',
            'aria-valuemax',
            'aria-valuemin',
            'aria-valuenow',
            'aria-valuetext',
            'role',
        ],
    ];

    public function afterGetConfig(Config $subject, DataObject $result): DataObject
    {
        $settings = $result->getData('settings');

        $extendedSettings = isset($settings['extended_valid_elements'])
            ? $settings['extended_valid_elements'] . ','
            : '';

        // documented setting, but doesn't work on it's own - svg's are still removed
        $settings['extended_valid_elements'] = $extendedSettings . implode(',', $this->buildExtendedValidElements());

        // non documented setting, see https://stackoverflow.com/a/48884025 - but it works with tinymce4 and tinymce5
        $settings['non_empty_elements'] =
            'td,th,iframe,video,audio,object,script,i,em,span,area,base,basefont,br,' . // default list
            'col,embed,frame,hr,img,input,isindex,link,meta,param,,source,wbr,track,' . // also default list
            implode(',', $this->buildNonEmptyElementsExtension()); // add svg related tags to list

        $result->setData('settings', $settings);

        return $result;
    }

    private function svgChildElements(): array
    {
        // An empty array [] means a wildcard is used as the valid attributes and [*] will be used.
        // To specify NO attributes are allowed, use [''].
        return [
            'a'                   => [],
            //'altGlyph', // deprecated
            //'altGlyphDef', // deprecated
            //'altGlyphItem', // deprecated
            'animate'             => [],
            'animateMotion'       => [],
            'animateTransform'    => [],
            'circle'              => [],
            'clipPath'            => [],
            //'color-profile', // deprecated
            //'cursor', // deprecated
            'defs'                => [],
            'desc'                => [],
            'ellipse'             => [],
            'feBlend'             => [],
            'feColorMatrix'       => [],
            'feComponentTransfer' => [],
            'feComposite'         => [],
            'feConvolveMatrix'    => [],
            'feDiffuseLighting'   => [],
            'feDisplacementMap'   => [],
            'feDistantLight'      => [],
            'feFlood'             => [],
            'feFuncA'             => [],
            'feFuncB'             => [],
            'feFuncG'             => [],
            'feFuncR'             => [],
            'feGaussianBlur'      => [],
            'feImage'             => [],
            'feMerge'             => [],
            'feMergeNode'         => [],
            'feMorphology'        => [],
            'feOffset'            => [],
            'fePointLight'        => [],
            'feSpecularLighting'  => [],
            'feSpotLight'         => [],
            'feTile'              => [],
            'feTurbulence'        => [],
            'filter'              => [],
            //'font', // deprecated
            //'font-face', // deprecated
            //'font-face-format', // deprecated
            //'font-face-name', // deprecated
            //'font-face-src', // deprecated
            //'font-face-uri', // deprecated
            'foreignObject'       => [],
            'g'                   => [],
            //'glyph', // deprecated
            //'glyphRef', // deprecated
            //'hkern', // deprecated
            'image'               => [],
            'line'                => [],
            'linearGradient'      => [],
            'marker'              => [],
            'mask'                => [],
            'metadata'            => [],
            //'missing-glyph', // deprecated
            'mpath'               => [],
            'path'                => [],
            'pattern'             => [],
            'polygon'             => [],
            'polyline'            => [],
            'radialGradient'      => [],
            'rect'                => [],
            //'script', // disabled because, easy to hide bad stuff here
            'set'                 => [],
            'stop'                => [],
            'style'               => [],
            'switch'              => [],
            'symbol'              => [],
            'text'                => [],
            'textPath'            => [],
            'title'               => [],
            //'tref', // deprecated
            'tspan'               => [],
            'use'                 => [],
            'view'                => [],
            //'vkern', // deprecated
        ];
    }

    private function buildExtendedValidElements(): array
    {
        $extend[] = 'svg[*]';
        foreach ($this->svgChildElements() as $element => $validAttributes) {
            $extend[] = $element . ($validAttributes === [] ? '[*]' : $this->implode($validAttributes));
        }
        return $extend;
    }

    private function buildNonEmptyElementsExtension(): array
    {
        return merge(['svg'], keys($this->svgChildElements()));
    }

    private function attributes(array $specific, string ...$attrGroups): string
    {
        $attrs = merge($specific, ...map(function (string $group): array {
            return self::ATTRS[$group];
        }, $attrGroups));

        return $this->implode($attrs);
    }

    private function implode(array $attrs): string
    {
        return implode('|', unique($attrs));
    }
}
