<?php declare(strict_types=1);

namespace Hyva\CmsWysiwyg\Model;

use function array_map as map;
use function array_merge as merge;
use function array_unique as unique;

/**
 * Contain information on SVG HTML elements and their valid attributes.
 *
 * Note: Any deprecated elements and the deprecated Xlink family of attributes are excluded.
 */
class SvgElements
{
    private const CORE = 'core';
    private const STYLE = 'style';
    private const PRESENTATION = 'presentation';
    private const CONDITIONAL_PROCESSING = 'conditionalProcessing';
    private const FILTER_PRIMITIVE = 'filterPrimitive';
    private const TRANSFER_FUNCTION = 'transferFunction';
    private const ANIMATION_TARGET_ELEMENT = 'animationTargetElement';
    private const ANIMATION_ATTRIBUTE_TARGET = 'animationAttributeTarget';
    private const ANIMATION_TIMING = 'animationTiming';
    private const ANIMATION_VALUE = 'animationValue';
    private const ANIMATION_ADDITION = 'animationAddition';
    private const ANIMATION_EVENT = 'animationEvent';
    private const DOCUMENT_EVENT = 'documentEvent';
    private const DOCUMENT_ELEMENT_EVENT = 'documentElementEvent';
    private const GLOBAL_EVENT = 'globalEvent';
    private const GRAPHICAL_EVENT = 'graphicalEvent';
    private const ARIA = 'aria';

    private const ATTRIBUTE_GROUPS = [
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
        self::CONDITIONAL_PROCESSING     => [
            'requiredExtensions',
            'requiredFeatures',
            'systemLanguage',
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

    /**
     * Return map of SVG elements to array of attributes.
     *
     * @return array[][]
     */
    public function getSvgElements(): array
    {
        $attributeGroups = function (...$groups): array {
            return unique(merge(...map(function ($group): array {
                return is_array($group)
                    ? $group
                    : (self::ATTRIBUTE_GROUPS[$group] ?? []);
            }, $groups)));
        };

        return [
            'svg'                 => $attributeGroups(
                ['height', 'preserveAspectRatio', 'viewBox', 'width', 'x', 'y'],
                self::CONDITIONAL_PROCESSING,
                self::STYLE,
                self::CONDITIONAL_PROCESSING,
                self::GLOBAL_EVENT,
                self::GRAPHICAL_EVENT,
                self::DOCUMENT_EVENT,
                self::DOCUMENT_ELEMENT_EVENT,
                self::PRESENTATION,
                self::ARIA
            ),
            'a'                   => $attributeGroups(
                ['href', 'hreflang', 'target', 'type'],
                self::CORE,
                self::STYLE,
                self::CONDITIONAL_PROCESSING,
                self::GLOBAL_EVENT,
                self::DOCUMENT_ELEMENT_EVENT,
                self::GRAPHICAL_EVENT,
                self::PRESENTATION,
                self::ARIA
            ),
            //'altGlyph', // deprecated
            //'altGlyphDef', // deprecated
            //'altGlyphItem', // deprecated
            'animate'             => $attributeGroups(
                self::ANIMATION_TIMING,
                self::ANIMATION_VALUE,
                self::ANIMATION_ADDITION,
                self::ANIMATION_ATTRIBUTE_TARGET,
                self::CORE,
                self::STYLE,
                self::GLOBAL_EVENT,
                self::DOCUMENT_ELEMENT_EVENT
            ),
            'animateMotion'       => $attributeGroups(
                ['keyPoints', 'path', 'rotate'],
                self::ANIMATION_TIMING,
                self::ANIMATION_VALUE,
                self::ANIMATION_ADDITION,
                self::ANIMATION_ATTRIBUTE_TARGET,
                self::ANIMATION_EVENT,
                self::CORE,
                self::STYLE,
                self::GLOBAL_EVENT,
                self::DOCUMENT_ELEMENT_EVENT
            ),
            'animateTransform'    => $attributeGroups(
                ['by', 'from', 'to', 'type'],
                self::CONDITIONAL_PROCESSING,
                self::CORE,
                self::ANIMATION_EVENT,
                self::ANIMATION_ATTRIBUTE_TARGET,
                self::ANIMATION_TIMING,
                self::ANIMATION_VALUE,
                self::ANIMATION_ADDITION
            ),
            'circle'              => $attributeGroups(
                ['cx', 'cy', 'r', 'pathLength'],
                self::CORE,
                self::STYLE,
                self::CONDITIONAL_PROCESSING,
                self::GLOBAL_EVENT,
                self::GRAPHICAL_EVENT,
                self::PRESENTATION,
                self::ARIA
            ),
            'clipPath'            => $attributeGroups(
                ['clipPathUnits'],
                self::CORE,
                self::STYLE,
                self::CONDITIONAL_PROCESSING,
                self::PRESENTATION
            ),
            //'color-profile', // deprecated
            //'cursor', // deprecated
            'defs'                => $attributeGroups(
                self::CORE,
                self::STYLE,
                self::GLOBAL_EVENT,
                self::DOCUMENT_ELEMENT_EVENT,
                self::GRAPHICAL_EVENT,
                self::PRESENTATION
            ),
            'desc'                => $attributeGroups(
                self::CORE,
                self::STYLE,
                self::GLOBAL_EVENT,
                self::DOCUMENT_ELEMENT_EVENT
            ),
            'ellipse'             => $attributeGroups(
                ['cx', 'cy', 'rx', 'ry', 'pathLength'],
                self::CORE,
                self::STYLE,
                self::CONDITIONAL_PROCESSING,
                self::GLOBAL_EVENT,
                self::GRAPHICAL_EVENT,
                self::PRESENTATION,
                self::ARIA
            ),
            'feBlend'             => $attributeGroups(
                ['in', 'in2', 'mode'],
                self::CORE,
                self::PRESENTATION,
                self::FILTER_PRIMITIVE,
                self::STYLE
            ),
            'feColorMatrix'       => $attributeGroups(
                
            ),
            'feComponentTransfer' => $attributeGroups(),
            'feComposite'         => $attributeGroups(),
            'feConvolveMatrix'    => $attributeGroups(),
            'feDiffuseLighting'   => $attributeGroups(),
            'feDisplacementMap'   => $attributeGroups(),
            'feDistantLight'      => $attributeGroups(),
            'feFlood'             => $attributeGroups(),
            'feFuncA'             => $attributeGroups(),
            'feFuncB'             => $attributeGroups(),
            'feFuncG'             => $attributeGroups(),
            'feFuncR'             => $attributeGroups(),
            'feGaussianBlur'      => $attributeGroups(),
            'feImage'             => $attributeGroups(),
            'feMerge'             => $attributeGroups(),
            'feMergeNode'         => $attributeGroups(),
            'feMorphology'        => $attributeGroups(),
            'feOffset'            => $attributeGroups(),
            'fePointLight'        => $attributeGroups(),
            'feSpecularLighting'  => $attributeGroups(),
            'feSpotLight'         => $attributeGroups(),
            'feTile'              => $attributeGroups(),
            'feTurbulence'        => $attributeGroups(),
            'filter'              => $attributeGroups(),
            //'font', // deprecated
            //'font-face', // deprecated
            //'font-face-format', // deprecated
            //'font-face-name', // deprecated
            //'font-face-src', // deprecated
            //'font-face-uri', // deprecated
            'foreignObject'       => $attributeGroups(),
            'g'                   => $attributeGroups(),
            //'glyph', // deprecated
            //'glyphRef', // deprecated
            //'hkern', // deprecated
            'image'               => $attributeGroups(),
            'line'                => $attributeGroups(),
            'linearGradient'      => $attributeGroups(),
            'marker'              => $attributeGroups(),
            'mask'                => $attributeGroups(),
            'metadata'            => $attributeGroups(),
            //'missing-glyph', // deprecated
            'mpath'               => $attributeGroups(),
            'path'                => $attributeGroups(),
            'pattern'             => $attributeGroups(),
            'polygon'             => $attributeGroups(),
            'polyline'            => $attributeGroups(),
            'radialGradient'      => $attributeGroups(),
            'rect'                => $attributeGroups(),
            //'script', // disabled because, easy to hide bad stuff here
            'set'                 => $attributeGroups(),
            'stop'                => $attributeGroups(),
            'style'               => $attributeGroups(),
            'switch'              => $attributeGroups(),
            'symbol'              => $attributeGroups(),
            'text'                => $attributeGroups(),
            'textPath'            => $attributeGroups(),
            'title'               => $attributeGroups(),
            //'tref', // deprecated
            'tspan'               => $attributeGroups(),
            'use'                 => $attributeGroups(),
            'view'                => $attributeGroups(),
            //'vkern', // deprecated
        ];
    }
}
