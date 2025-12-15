/**
 * Block: Hero
 */

import { registerBlockType } from '@wordpress/blocks';
import {
	useBlockProps,
	RichText,
	BlockControls,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
	URLInput,
} from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import {
	Button,
	PanelBody,
	SelectControl,
	ColorPalette,
	Dashicon,
	ToolbarGroup,
	ToolbarButton,
	Popover,
} from '@wordpress/components';
import { useState } from '@wordpress/element';
import { link } from '@wordpress/icons';

registerBlockType( 'legacy-pro-max/hero', {
	edit: ( { attributes, setAttributes, isSelected } ) => {
		const {
			headline,
			subheading,
			buttonText,
			buttonUrl,
			backgroundType,
			backgroundColor,
			backgroundImage,
			backgroundVideo,
		} = attributes;

		const [ isLinkPickerVisible, setIsLinkPickerVisible ] = useState( false );

		const onSelectImage = ( media ) => {
			setAttributes( { backgroundImage: media.url } );
		};

		const onSelectVideo = ( media ) => {
			setAttributes( { backgroundVideo: media.url } );
		};

		const blockStyles = {
			backgroundColor:
				backgroundType === 'color' ? backgroundColor : undefined,
			backgroundImage:
				backgroundType === 'image'
					? `url(${ backgroundImage })`
					: undefined,
			backgroundSize: 'cover',
			backgroundPosition: 'center',
		};

		const blockProps = useBlockProps( { style: blockStyles } );

		return (
			<>
				<BlockControls>
					<ToolbarGroup>
						<ToolbarButton
							icon={ link }
							title={ __( 'Link', 'legacy-pro-max' ) }
							onClick={ () => setIsLinkPickerVisible( true ) }
						/>
					</ToolbarGroup>
				</BlockControls>
				<InspectorControls>
					<PanelBody
						title={ __( 'Background Settings', 'legacy-pro-max' ) }
						initialOpen={ true }
					>
						<SelectControl
							label={ __( 'Background Type', 'legacy-pro-max' ) }
							value={ backgroundType }
							options={ [
								{
									label: __( 'Color', 'legacy-pro-max' ),
									value: 'color',
								},
								{
									label: __( 'Image', 'legacy-pro-max' ),
									value: 'image',
								},
								{
									label: __( 'Video', 'legacy-pro-max' ),
									value: 'video',
								},
							] }
							onChange={ ( newType ) =>
								setAttributes( { backgroundType: newType } )
							}
						/>
						{ backgroundType === 'color' && (
							<ColorPalette
								value={ backgroundColor }
								onChange={ ( newColor ) =>
									setAttributes( {
										backgroundColor: newColor,
									} )
								}
							/>
						) }
						{ backgroundType === 'image' && (
							<MediaUploadCheck>
								<MediaUpload
									onSelect={ onSelectImage }
									allowedTypes={ [ 'image' ] }
									value={ backgroundImage }
									render={ ( { open } ) => (
										<Button
											onClick={ open }
											isPrimary={ true }
										>
											{ __(
												'Select Image',
												'legacy-pro-max'
											) }
										</Button>
									) }
								/>
							</MediaUploadCheck>
						) }
						{ backgroundType === 'video' && (
							<MediaUploadCheck>
								<MediaUpload
									onSelect={ onSelectVideo }
									allowedTypes={ [ 'video' ] }
									value={ backgroundVideo }
									render={ ( { open } ) => (
										<Button
											onClick={ open }
											isPrimary={ true }
										>
											{ __(
												'Select Video',
												'legacy-pro-max'
											) }
										</Button>
									) }
								/>
							</MediaUploadCheck>
						) }
					</PanelBody>
				</InspectorControls>
				<div { ...blockProps }>
					{ isLinkPickerVisible && isSelected && (
						<Popover
							position="bottom center"
							onClose={ () => setIsLinkPickerVisible( false ) }
						>
							<URLInput
								value={ buttonUrl }
								onChange={ ( newButtonUrl ) =>
									setAttributes( { buttonUrl: newButtonUrl } )
								}
							/>
						</Popover>
					) }
					{ backgroundType === 'video' && (
						<div className="hero-video-placeholder">
							<Dashicon icon="format-video" />
							<p>
								{ __(
									'Video background is active. Preview on the front-end.',
									'legacy-pro-max'
								) }
							</p>
						</div>
					) }
					<div className="hero__content">
						<RichText
							tagName="h1"
							className="hero__headline"
							placeholder={ __(
								'Enter Headline',
								'legacy-pro-max'
							) }
							value={ headline }
							onChange={ ( newHeadline ) =>
								setAttributes( { headline: newHeadline } )
							}
						/>
						<RichText
							tagName="p"
							className="hero__subheading"
							placeholder={ __(
								'Enter Subheading',
								'legacy-pro-max'
							) }
							value={ subheading }
							onChange={ ( newSubheading ) =>
								setAttributes( { subheading: newSubheading } )
							}
						/>
						<div className="hero__button-wrapper">
							<RichText
								tagName="div"
								className="btn hero__button"
								placeholder={ __(
									'Button Text',
									'legacy-pro-max'
								) }
								value={ buttonText }
								onChange={ ( newButtonText ) =>
									setAttributes( {
										buttonText: newButtonText,
									} )
								}
								allowedFormats={ [] }
							/>
						</div>
					</div>
				</div>
			</>
		);
	},
	save: () => {
		return null;
	},
} );
