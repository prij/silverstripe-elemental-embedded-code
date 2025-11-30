<?php

namespace Dynamic\Elements\Embedded\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;

/**
 * Class ElementEmbeddedCode
 */
class ElementEmbeddedCode extends BaseElement
{
    private static string $icon = 'font-icon-code';

    private static string $singular_name = 'Embedded Code Element';

    private static string $plural_name = 'Embedded Code Elements';

    private static string $description = 'Embed code like iFrames or Javascript on a page.';

    private static string $table_name = 'ElementEmbeddedCode';

    private static array $db = [
        'Content' => 'HTMLText',
        'Code' => 'HTMLText',
    ];

    public function getCMSFields(): FieldList
    {
        $fields = parent::getCMSFields();
        $fields->replaceField(
            'Code',
            TextareaField::create('Code')
                ->setTitle('Embed Code')
        );

        return $fields;
    }

    public function getType(): string
    {
        return _t(__CLASS__ . '.BlockType', 'Embedded Code');
    }

    public function getSummary(): DBHTMLText
    {
        return DBField::create_field('HTMLText', $this->Code)->Summary(20);
    }

    protected function provideBlockSchema(): array
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->getSummary();
        return $blockSchema;
    }
}
