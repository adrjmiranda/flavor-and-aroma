import 'quill/dist/quill.snow.css';

import Quill from 'quill/core';

import Toolbar from 'quill/modules/toolbar';
import Snow from 'quill/themes/snow';

import Bold from 'quill/formats/bold';
import Italic from 'quill/formats/italic';
import Header from 'quill/formats/header';
import Underline from 'quill/formats/underline';
import Image from 'quill/formats/image';
import Strike from 'quill/formats/strike';
import Blockquote from 'quill/formats/blockquote';
import CodeBlock from 'quill/formats/code';
import Script from 'quill/formats/script';
import List from 'quill/formats/list';
import Link from 'quill/formats/link';
import Video from 'quill/formats/video';
import Formula from 'quill/formats/formula';

Quill.register({
	'modules/toolbar': Toolbar,
	'themes/snow': Snow,
	'formats/bold': Bold,
	'formats/italic': Italic,
	'formats/header': Header,
	'formats/underline': Underline,
	'formats/image': Image,
	'formats/strike': Strike,
	'formats/blockquote': Blockquote,
	'formats/code-block': CodeBlock,
	'formats/script': Script,
	'formats/list': List,
	'formats/link': Link,
	'formats/video': Video,
	'formats/formula': Formula,
});

const toolbarOptions = [
	['bold', 'italic', 'underline', 'strike'],
	['blockquote', 'code-block'],
	['link', 'image', 'video', 'formula'],
	[{ header: 1 }, { header: 2 }],
	[{ list: 'ordered' }, { list: 'bullet' }, { list: 'check' }],
	[{ script: 'sub' }, { script: 'super' }],
	[{ indent: '-1' }, { indent: '+1' }],
	[{ header: [1, 2, 3, 4, 5, 6, false] }],
	['clean'],
];

new Quill('#editor', {
	theme: 'snow',
	placeholder: 'Add a new recipe',
	modules: {
		toolbar: toolbarOptions,
	},
});

export default Quill;
