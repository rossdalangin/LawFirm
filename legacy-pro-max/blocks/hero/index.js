/**
 * Block: Hero
 */

import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, RichText, URLInput } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { Button } from '@wordpress/components';

registerBlockType( 'legacy-pro-max/hero', {
	edit: ( { attributes, setAttributes } ) => {
		const blockProps = useBlockProps();

		return (
			<div { ...blockProps }>
				<RichText
					tagName="h1"
					placeholder={ __( 'Enter Headline', 'legacy-pro-max' ) }
					value={ attributes.headline }
					onChange={ ( headline ) => setAttributes( { headline } ) }
				/>
				<RichText
					tagName="p"
					placeholder={ __( 'Enter Subheading', 'legacy-pro-max' ) }
					value={ attributes.subheading }
					onChange={ ( subheading ) => setAttributes( { subheading } ) }
				/>
				<RichText
					tagName="div"
					className="btn"
					placeholder={ __( 'Button Text', 'legacy-pro-max' ) }
					value={ attributes.buttonText }
					onChange={ ( buttonText ) => setAttributes( { buttonText } ) }
					allowedFormats={ [] }
				/>
				<URLInput
					value={ attributes.buttonUrl }
					onChange={ ( buttonUrl, post ) => setAttributes( { buttonUrl, buttonText: (post && post.title) || attributes.buttonText } ) }
				/>
			</div>
		);
	},
	save: () => {
		return null;
	},
} );
