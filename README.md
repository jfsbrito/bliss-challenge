Custom WordPress Theme - Bliss Challenge
Description
This is a custom WordPress theme designed to meet specific functional and technical requirements. The theme includes various components and templates to create a tailored website experience.

Functional Requirements
Homepage: The theme provides a homepage with a header, hero section, footer, and two Gutenberg blocks.

Slider Gallery Block: One of the Gutenberg blocks features an editable slider gallery in the backend.

Article Details: Users can click on articles from the list to view full details.

Search Page: The homepage includes a link to a search page where users can find articles and includes a search field.

Events Page: Users can access an events page from the homepage, listing events as a custom post type, and implementing pagination.

Technical Requirements
Plugin-Free: The theme has been developed without relying on additional plugins.

Responsiveness: It is fully responsive and provides a consistent user experience across different devices.

Code Comments: The codebase is well-commented for clarity and maintainability.

Theme Structure
The theme directory structure is organized as follows:

bliss-challenge/
│
├── assets/
│   ├── images/
│   ├── js/
│   │   └── main.js
│
├── framework/
│   ├── admin/
│   ├── cpt/
│   │   └── events.php
│   ├── gutenberg-blocks/
│   │   ├── slider-gallery/
│   │   │   ├── slider-gallery.php
│   │   │   ├── slider-gallery-editor.css
│   │   │   ├── slider-gallery-editor.js
│   │   │   ├── slider-gallery-front.css
│   │   │   └── slider-gallery-front.js
│   ├── modules/
│   │   ├── head/
│   │   │   ├── head.php
│   │   │   └── module.php
│   │   └── optimize/
│   │       └── disable-futures.php
│
├── pages-templates/
│   └── front-page.php
│
├── template-parts/
│   ├── events/
│   │   ├── content-loop.php
│   │   └── content-single.php
│   ├── posts/
│   │   ├── content-loop.php
│   │   └── content-single.php
│   └── general/
│       ├── footer-content.php
│       └── header-content.php
│
├── 404.php
├── archive.php
├── footer.php
├── front-page.php
├── functions.php
├── header.php
├── home.php
├── index.php
├── screenshot.png
├── search.php
├── single.php
├── style.css


Installation
Download WordPress from the official website: https://wordpress.org/download/.

Unzip the downloaded folder and copy its contents to the root directory of your web server.

Download the bliss-challenge.zip theme file.

Unzip the theme folder and copy its contents to the themes directory in the root of your WordPress installation. Ensure that the theme is located at wp-content/themes/bliss-challenge/.

Access the WordPress admin panel (typically at http://yoursite.com/wp-admin/).

Navigate to the "Appearance" section in the left sidebar.

Click on the "Themes" option.

You will find the "bliss-challenge" theme listed among the available themes. Click the "Activate" button below the theme name.

Your custom "bliss-challenge" theme is now active and ready to be customized according to your specific requirements. Refer to the individual directories and files for further customization options.

Please note that this README provides an overview of the theme's structure and installation process. Additional documentation and instructions for customizing and configuring the theme may be provided in other files or resources within the theme directory.
