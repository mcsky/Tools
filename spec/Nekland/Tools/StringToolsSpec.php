<?php

namespace spec\Nekland\Tools;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StringToolsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Nekland\Tools\StringTools');
    }

    function it_should_transform_snake_case_to_camel_case()
    {
        $this::camelize('hello_world')->shouldReturn('HelloWorld');
    }

    function it_should_transform_kebab_case_to_camel_case()
    {
        $this::camelize('hello-world', '-')->shouldReturn('HelloWorld');
    }

    function it_should_not_transform_others_than_kebab_or_snake_case()
    {
        $this::shouldThrow('\InvalidArgumentException')->duringCamelize('hello@world', '@');
    }

    function it_should_check_if_string_starts_with_needle()
    {
        $this::startsWith('Lorem ipsum heyà', 'Lorem')->shouldReturn(true);
        $this::startsWith(' Lorem ipsum heyà', 'Lorem')->shouldReturn(false);
        $this::startsWith("\nLorem ipsum heyà", 'Lorem')->shouldReturn(false);
        $this::startsWith(' ipsum heyà Lorem', 'Lorem')->shouldReturn(false);
        $this::startsWith(' ipsum heyà Lorem', '')->shouldReturn(true);
    }

    function it_should_check_if_string_ends_with_needle()
    {
        $this::endsWith('Foo bar baz ça marche', 'marche')->shouldReturn(true);
        $this::endsWith('Foo bar baz ça marche ', 'marche')->shouldReturn(false);
        $this::endsWith('Foo bar marche baz ça ', 'marche')->shouldReturn(false);
        $this::endsWith('marche Foo bar baz ça ', 'marche')->shouldReturn(false);
        $this::endsWith('marche Foo bar baz ça ', '')->shouldReturn(true);
    }

    function it_should_remove_the_start_of_a_string()
    {
        $this::removeStart('Foo bar baz', 'Foo')->shouldReturn(' bar baz');
        $this::removeStart('YOLOOOsgs gs gsg sggs g', 'g')->shouldReturn('YOLOOOsgs gs gsg sggs g');
    }
}
