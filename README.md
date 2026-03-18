# Krieger Flagship Content Types (v3.0)

**Internal Plugin for krieger.jhu.edu**

A modernized version of the core content registration plugin for the Johns Hopkins University Krieger School of Arts and Sciences flagship website. Version 3.0 moves away from custom PHP meta boxes in favor of **ACF Local Field Groups** for better maintainability and REST API support.

---

## 📋 Overview

This plugin manages the **Fields of Study** (academic programs) ecosystem. It handles the registration of the Custom Post Type (CPT), associated taxonomies, and the metadata fields required for the program directory and search filters.

## 🚀 Registered Post Types

### 1. Fields of Study (`studyfields`)
* **Slug:** `/fields/`
* **Menu Icon:** `dashicons-welcome-learn-more`
* **Supports:** Title, Revisions, Page Attributes, REST API.
* **Hierarchical:** Yes (allows for parent/child program relationships).

## 🏷️ Taxonomies

| Taxonomy | Slug | Description |
| :--- | :--- | :--- |
| **Program Types** | `program_type` | Categorizes degrees (e.g., Undergraduate, Graduate). |
| **Interest Areas** | `interest-area` | Subject-based grouping (e.g., Humanities, Natural Sciences). |

---

## 🛠️ Data Structure (ACF Local Fields)

Metadata is handled via `acf_add_local_field_group`. This ensures fields are available immediately upon plugin activation without requiring manual JSON imports.

### Field Groups:

* **Contact Information:** `ecpt_emailaddress`
* **Academic Details:** `ecpt_majors`, `ecpt_minors`, `ecpt_degreesoffered`, `ecpt_pcitext`.
* **Website URLs:** `ecpt_homepage` (Standardized URL field).
* **Content & Media:** `ecpt_headline`, `ecpt_keywords` (for Isotope search optimization).
* **Extra Degree Meta:** Detailed checkboxes for specific degree designations:
    * `undergraduate_degree_type` (BA, BS)
    * `graduate_degree_type` (MA, MFA, MS, PhD, Certificate)
    * `combined_degree_type` (BA/MA, BS/MS, etc.)

---

## 🔧 Installation & Deployment

1. **Prerequisite:** Requires [Advanced Custom Fields (ACF) Pro](https://www.advancedcustomfields.com/) to be active on the site.
2. **Directory:** Upload to `wp-content/plugins/ksas-flagship-content-types`.
3. **Activation:** Activate via the WordPress Admin.
4. **Permalinks:** Navigate to **Settings > Permalinks** and click **Save Changes** to flush rewrite rules.

## 🔒 Security & Standards

* **Modernized Logic:** Version 3.0 uses `if ( ! defined( 'ABSPATH' ) ) exit;` to prevent direct script access.
* **REST API Ready:** All post types and taxonomies have `show_in_rest => true` for compatibility with the Block Editor and headless applications.
* **I18n:** All strings are wrapped in `__()` or `_x()` using the `ksas-flagship` text domain.

---

### License
Copyright (c) 2026 KSAS Communications. Internal use only for Johns Hopkins University properties.