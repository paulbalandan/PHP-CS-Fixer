<?php

declare(strict_types=1);

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace PhpCsFixer\Tests\Tokenizer\Transformer;

use PhpCsFixer\Tests\Test\AbstractTransformerTestCase;
use PhpCsFixer\Tokenizer\CT;

/**
 * @author Gregor Harlan <gharlan@web.de>
 *
 * @internal
 *
 * @covers \PhpCsFixer\Tokenizer\Transformer\NamespaceOperatorTransformer
 *
 * @phpstan-import-type _TransformerTestExpectedTokens from AbstractTransformerTestCase
 */
final class NamespaceOperatorTransformerTest extends AbstractTransformerTestCase
{
    /**
     * @param _TransformerTestExpectedTokens $expectedTokens
     *
     * @dataProvider provideProcessCases
     */
    public function testProcess(string $source, array $expectedTokens): void
    {
        $this->doTest(
            $source,
            $expectedTokens,
            [
                \T_NAMESPACE,
                CT::T_NAMESPACE_OPERATOR,
            ]
        );
    }

    /**
     * @return iterable<int, array{string, _TransformerTestExpectedTokens}>
     */
    public static function provideProcessCases(): iterable
    {
        yield [
            '<?php
namespace Foo;
namespace\Bar\baz();
',
            [
                1 => \T_NAMESPACE,
                6 => CT::T_NAMESPACE_OPERATOR,
            ],
        ];
    }
}
