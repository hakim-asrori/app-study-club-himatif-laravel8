/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

 CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'id';
	// config.uiColor = '#AADC6E';

	config.toolbarGroups = [
	{ name: 'styles', groups: [ 'styles' ] },
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	{ name: 'links', groups: [ 'links' ] },
	{ name: 'insert', groups: [ 'insert' ] },
	{ name: 'forms', groups: [ 'forms' ] },
	{ name: 'tools', groups: [ 'tools' ] },
	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
	{ name: 'others', groups: [ 'others' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
	{ name: 'colors', groups: [ 'colors' ] },
	{ name: 'about', groups: [ 'about' ] }
	];
};
