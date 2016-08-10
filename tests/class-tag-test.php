<?php

namespace Frozzare\Tests\Forms;

use Frozzare\Forms\Tag;

class Tag_Test extends \WP_UnitTestCase {

	public function test_input_tag() {
		$tag = new Tag( 'input', '', ['type' => 'string'], true, true );
		$this->assertSame( '<input type="string" />', $tag->render() );
		$this->assertTrue( $tag->is_xhtml() );
	}

	public function test_p_tag() {
		$tag = new Tag( 'p', 'Hello' );
		$this->assertSame( '<p>Hello</p>', $tag->render() );
	}

	public function test_p_tag_class() {
		$tag = new Tag( 'p', 'Hello', ['class' => 'foo'] );
		$this->assertSame( '<p class="foo">Hello</p>', $tag->render() );
	}

	public function test_ul_tag() {
		$tag = new Tag( 'ul', new Tag( 'li', 'Hello' ) );
		$this->assertSame( '<ul><li>Hello</li></ul>', $tag->render() );
	}

	public function test_close() {
		$tag = new Tag( 'p' );
		$this->assertSame( '</p>', $tag->close() );
	}

	public function test_escape() {
		$tag = new Tag( 'p', 'Hello' );
		$this->assertSame( 'Hello', $tag->escape( $tag->get_value() ) );
		$this->assertSame( 'Hello', $tag->escape( $tag->get_value(), true ) );
		$this->assertSame( '&lt;p&gt;Hello&lt;/p&gt;', $tag->escape( '<p>Hello</p>' ) );
		$this->assertSame( '&lt;p&gt;Hello&lt;/p&gt;', $tag->escape( '<p>Hello</p>', true ) );
	}

	public function test_get_name() {
		$tag = new Tag( 'p' );
		$this->assertSame( 'p', $tag->get_name() );
	}

	public function test_get_value() {
		$tag = new Tag( 'p', 'Hello' );
		$this->assertSame( 'Hello', $tag->get_value() );
	}

	public function test_html_attributes() {
		$tag = new Tag( 'p', 'Hello', ['foo' => 'bar'] );
		$this->assertSame( 'foo="bar"', trim( $tag->attributes() ) );
		$this->assertSame( 'bar="foo"', trim( $tag->attributes( ['bar' => 'foo'] ) ) );
		$this->assertSame( 'bar=\'["foo"]\'', trim( $tag->attributes( ['bar' => ['foo']] ) ) );
	}

	public function test_html_value() {
		$tag = new Tag( 'p', 'Hello' );
		$this->assertSame( 'Hello', $tag->value() );
		$this->assertSame( 'bar', $tag->value( ['bar'] ) );
		$this->assertSame( '<p>Hello</p>', $tag->value( $tag ) );
	}

	public function test_open() {
		$tag = new Tag( 'p' );
		$this->assertSame( '<p>', $tag->open() );
	}

	public function test_set_value() {
		$tag = new Tag( 'p', 'Hello' );
		$tag->set_value( ['foo' => 'bar'] );
		$this->assertSame( ['foo' => 'bar'], $tag->get_value() );

		try {
			$tag->set_value( (object) [] );
			$this->assertFalse( true );
		} catch ( \Exception $e ) {
			$this->assertNotEmpty( $e->getMessage() );
		}
	}
}