<?php

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * Original code based on the CommonMark JS reference parser (https://bitly.com/commonmark-js)
 *  - (c) John MacFarlane
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\CommonMark;

/**
 * Converts CommonMark-compatible Markdown to HTML.
 */
class Converter implements ConverterInterface
{
    /**
     * The document parser instance.
     *
     * @var \League\CommonMark\DocParserInterface
     */
    protected $docParser;

    /**
     * The html renderer instance.
     *
     * @var \League\CommonMark\ElementRendererInterface
     */
    protected $htmlRenderer;

    /**
     * Create a new commonmark converter instance.
     *
     * @param DocParserInterface       $docParser
     * @param ElementRendererInterface $htmlRenderer
     */
    public function __construct(DocParserInterface $docParser, ElementRendererInterface $htmlRenderer)
    {
        $this->docParser = $docParser;
        $this->htmlRenderer = $htmlRenderer;
    }

    /**
     * Converts CommonMark to HTML.
     *
     * @param string $commonMark
     *
     * @throws \RuntimeException
     *
     * @return string
     *
     * @api
     */
    public function convertToHtml(string $commonMark): string
    {
        $documentAST = $this->docParser->parse($commonMark);

        return $this->htmlRenderer->renderBlock($documentAST);
    }

    /**
     * Converts CommonMark to HTML.
     *
     * @see Converter::convertToHtml
     *
     * @param string $commonMark
     *
     * @throws \RuntimeException
     *
     * @return string
     */
    public function __invoke(string $commonMark): string
    {
        return $this->convertToHtml($commonMark);
    }
}
