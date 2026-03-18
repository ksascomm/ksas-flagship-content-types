<?php
/**
 * Plugin Name: Krieger Flagship Content Types
 * Plugin URI: http://krieger.jhu.edu/
 * Description: Modernized for 2026. Manages Fields of Study using ACF Local Fields.
 * Version: 3.0
 * Author: KSAS Communications
 * License: GPL2
 *
 * @package KriegerFlagshipContentTypes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * 1. Registers the 'Fields of Study' Custom Post Type.
 *
 * @return void
 */
function ksas_register_content_types() {
	// Fields of Study.
	register_post_type(
		'studyfields',
		array(
			'labels'       => array(
				'name'               => _x( 'Fields of Study', 'post type general name', 'ksas-flagship' ),
				'singular_name'      => _x( 'Field of Study', 'post type singular name', 'ksas-flagship' ),
				'add_new'            => __( 'Add New Field of Study', 'ksas-flagship' ),
				'add_new_item'       => __( 'Add New Field of Study', 'ksas-flagship' ),
				'edit_item'          => __( 'Edit Field of Study', 'ksas-flagship' ),
				'new_item'           => __( 'New Field of Study', 'ksas-flagship' ),
				'view_item'          => __( 'View Field of Study', 'ksas-flagship' ),
				'search_items'       => __( 'Search Fields of Study', 'ksas-flagship' ),
				'not_found'          => __( 'No Fields of Study found', 'ksas-flagship' ),
				'not_found_in_trash' => __( 'No Fields of Study found in Trash', 'ksas-flagship' ),
				'menu_name'          => __( 'Fields of Study', 'ksas-flagship' ),
			),
			'public'       => true,
			'menu_icon'    => 'dashicons-welcome-learn-more',
			'supports'     => array( 'title', 'revisions', 'page-attributes' ),
			'show_in_rest' => true,
			'hierarchical' => true,
			'rewrite'      => array(
				'slug'       => 'fields',
				'with_front' => false,
			),
		)
	);
}
add_action( 'init', 'ksas_register_content_types' );

/**
 * 2. Registers the 'Program Type' and 'Interest Area' Taxonomies.
 *
 * @return void
 */
function ksas_register_taxonomies() {
	register_taxonomy(
		'program_type',
		'studyfields',
		array(
			'labels'            => array(
				'name'          => 'Program Types',
				'singular_name' => 'Program Type',
			),
			'public'            => true,
			'hierarchical'      => true,
			'show_in_rest'      => true,
			'show_admin_column' => true, // Adds to the admin list table automatically.
			'rewrite'           => array( 'slug' => 'program-type' ),
		)
	);

	register_taxonomy(
		'interest-area',
		'studyfields',
		array(
			'labels'            => array(
				'name'          => 'Interest Areas',
				'singular_name' => 'Interest Area',
			),
			'hierarchical'      => true,
			'show_in_rest'      => true,
			'public'            => true,
			'show_admin_column' => true,
		)
	);
}
add_action( 'init', 'ksas_register_taxonomies' );

/**
 * 3. Registers ACF Local Field Groups for the studyfields post type.
 *
 * @return void
 */
add_action(
	'acf/include_fields',
	function () {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		// Contact & Basic Info.
		acf_add_local_field_group(
			array(
				'key'      => 'group_study_contact',
				'title'    => 'Contact Information',
				'fields'   => array(
					array(
						'label' => 'Email',
						'name'  => 'ecpt_emailaddress',
						'type'  => 'email',
						'key'   => 'field_study_email',
					),
				),
				'location' => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'studyfields',
						),
					),
				),
			)
		);

		// Academic Details.
		acf_add_local_field_group(
			array(
				'key'      => 'group_study_academic',
				'title'    => 'Academic Details',
				'fields'   => array(
					array(
						'label' => 'Majors',
						'name'  => 'ecpt_majors',
						'type'  => 'text',
						'key'   => 'field_study_majors',
					),
					array(
						'label' => 'Minors',
						'name'  => 'ecpt_minors',
						'type'  => 'text',
						'key'   => 'field_study_minors',
					),
					array(
						'label' => 'Degrees Offered',
						'name'  => 'ecpt_degreesoffered',
						'type'  => 'text',
						'key'   => 'field_study_degrees',
					),
					array(
						'label' => 'Alt Major/Minor Text',
						'name'  => 'ecpt_pcitext',
						'type'  => 'textarea',
						'key'   => 'field_study_alt_text',
					),
				),
				'location' => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'studyfields',
						),
					),
				),
			)
		);

		// Website Links.
		acf_add_local_field_group(
			array(
				'key'      => 'group_study_links',
				'title'    => 'Website URLs',
				'fields'   => array(
					array(
						'label' => 'Homepage',
						'name'  => 'ecpt_homepage',
						'type'  => 'url',
						'key'   => 'field_study_home',
					),
				),
				'location' => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'studyfields',
						),
					),
				),
			)
		);

		// Content & Media Group.
		acf_add_local_field_group(
			array(
				'key'      => 'group_study_content',
				'title'    => 'Content & Media',
				'fields'   => array(
					array(
						'label' => 'Headline',
						'name'  => 'ecpt_headline',
						'type'  => 'text',
						'key'   => 'f_study_head',
					),
					array(
						'label' => 'Keywords',
						'name'  => 'ecpt_keywords',
						'type'  => 'textarea',
						'key'   => 'f_study_key',
					),
				),
				'location' => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'studyfields',
						),
					),
				),
			)
		);

		// Corrected Extra Degree Meta Group.
		acf_add_local_field_group(
			array(
				'key'                   => 'group_6807d4d5b0f64',
				'title'                 => 'Fields of Study Extra Meta',
				'fields'                => array(
					array(
						'key'           => 'field_6807d4d679d78',
						'label'         => 'Undergraduate Degree Type',
						'name'          => 'undergraduate_degree_type',
						'type'          => 'checkbox',
						'choices'       => array(
							'ba' => 'BA',
							'bs' => 'BS',
						),
						'return_format' => 'label',
						'layout'        => 'vertical',
					),
					array(
						'key'           => 'field_6807d52a35aa8',
						'label'         => 'Graduate Degree Type',
						'name'          => 'graduate_degree_type',
						'type'          => 'checkbox',
						'choices'       => array(
							'ma'          => 'MA',
							'mfa'         => 'MFA',
							'ms'          => 'MS',
							'phd'         => 'PhD',
							'certificate' => 'Certificate',
						),
						'return_format' => 'label',
						'layout'        => 'vertical',
					),
					array(
						'key'           => 'field_6808e270e9c50',
						'label'         => 'Combined Degree Type',
						'name'          => 'combined_degree_type',
						'type'          => 'checkbox',
						'choices'       => array(
							'bama'   => 'BA/MA',
							'bams'   => 'BA/MS',
							'bamha'  => 'BA/MHA',
							'bamhs'  => 'BA/MHS',
							'bamsph' => 'BA/MSPH',
							'bsms'   => 'BS/MS',
							'bsma'   => 'BS/MA',
						),
						'return_format' => 'label',
						'layout'        => 'vertical',
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'studyfields',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'active'                => true,
				'show_in_rest'          => 0,
			)
		);
	}
);
