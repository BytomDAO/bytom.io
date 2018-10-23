=== Advanced Contact form 7 DB ===
Contributors: vsourz1td
Tags: contact form 7 db, advanced cf7 db, contact form 7 database, contact form db, contact form 7, save form data, save contact form, save cf7, database, cf7db, save-contact-form, Save-Forms-Data, import-cf7, export-contact-data, view-cf7-entry
Requires at least: 4.0
Tested up to: 4.9.8
Stable tag: 1.4.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Save all contact form 7 form submitted data to the database, View, Ordering, Change field labels and Import/Export data using CSV.

== Description ==
Plug and Play, No Confrontation is required after install and activated, you can see it in wp-admin.

Each and every submission of Contact Form 7 is stored in the database and manage easily using the default WordPress interface. There is a nice drop-down to select the form and view all form data for that particular form. you can filter by searching keywords or select a date range.
	
Attached files are stored in the /wp-content/uploads/advanced-cf7-upload directory and also download from wp-admin.


= Features =
* **Multisite compatible** to store individual site wise contact form data.
* Save Contact Form 7 form submitted data to the database.
* Easy to update/edit enquiry data.
* Display **all** created contact form 7 form list.
* Keyword search for all the entries of selected form.
* **Date range filter** to filter specific date related entries easily.
* **Export all**, or only searched, filtered results with selected fields.
* Export data in **CSV**, **EXCEL** and **PDF** file.
* Display attachment download link.
* Given **advance pagination** on the listing screen so all the records are not loaded at once, to save resources.
* Given go to page functionality within pagination so view specific page related entries.
* **Enable or disable columns display**.
* **Drag and drop** to reorder columns once the entries are stored.
* Multiple select of records and selected records will be deleted or export in the sheet.
* Facility to update each record.
* Easy to update each field label name.
* Easy to setup **import functionality.**
* Facility to import form related entries from CSV file.
* Provided filters for excluding particular contact form entry to CF7 DB.
* Provided filter to add,modify,remove CF7 fields and data before submitting to CF7 DB.

== Commercial Features ==
**1. Advanced CF7 DB - GDPR compliant**
Advanced CF7 DB – GDPR compliant plugin assists website and web-shop owners to comply with European privacy regulations known as GDPR. Advanced CF7 DB – GDPR compliant is an add-on of Advanced Cf7 DB, based on GDPR rules to Export or Erase user’s personal data stored with advanced cf7 DB. For more details you can check the below download link.

You can download the plugin from <a target="_blank" href="https://codecanyon.net/item/advanced-cf7-db-gdpr-compliant/22386060">here</a>

= Advanced CF7 DB - GDPR compliant Plugin Features =
* Compatible with the latest WordPress version 4.9.6 and later for GDPR compliances. Meets with the new regulations for the data to be handled.
* Individual CF7 form wise settings to show the personal data on user’s request.
* Erase only the CF7 form personal data, that are required.
* Site owners can export a ZIP file containing a user’s personal data, including data collected by Advanced CF7 DB plugin.
* Site owners can erase a user’s personal data, including data collected by Advanced CF7 DB plugin.

**2. Schedule Report**
We have also introduced new feature "Schedule Report". This add-on is specially for businesses that require daily, weekly or monthly reports for the data that are stored at **Advanced Contact form 7 DB**. **Schedule Report For Advanced CF7 DB** plugin will do the same and send the email as per schedule set(Daily, Monthly, Weekly or Yearly) with report attachment. 

You can download the plugin from <a target="_blank" href="https://codecanyon.net/item/schedule-report-for-advanced-cf7-db/21560647?s_rank=8">here</a>

= Schedule Report Plugin Features =
* Automatically generating the CSV report, Send an email with report attachment based on the scheduled time.
* Option to create more than one scheduling event to get different enquiry form data report.
* Option to select report datasheet columns from enquiry form field.
* Provision to filter the data while creating the scheduled event for the particular report.
* You can manage the email content by defining TO, FROM and email body content for each scheduling event.
* The added schedule event will be added to WordPress cron schedule and accordingly will be fire at the scheduled time.

**3. Advanced CF7 DB - User Access Manager**
Need to provide access to other users? Your, search ends now, this plugin provides access to individual users OR based on user Role and accordingly user can view or edit the contact form DB data. For more details you can check the below download link.

You can download the plugin from <a target="_blank" href="https://codecanyon.net/item/advanced-cf7-db-user-access-manager/22058788">here</a>
 
= Advanced CF7 DB - User Access Manager Plugin Features =
* Provide access of contact form 7 DB to View & Update data to individual users OR based on user Role.
* Provide access of Single/Multiple forms to single user.


== Plugin Customization ==
= Restrict IP address storage =
* Some of Countries have introduced a Law to don't store the user's IP addresses into the database, So we had given provision to Restrict IP address storage.

= How to Restrict IP address storage? =
1. Goto -> wp-content/themes/{active theme folder}/functions.php
2. Open the functions.php file and place the code **do_shortcode( '[cf7-db-display-ip]' );** at the end of the file.

**Need Support?** <mehul@vsourz.com>

= How to use? =
1. Install Plugin via WordPress Admin - Go to Admin > Plugins > Add New.
2. View form entries Go To Admin >> Advanced CF7 DB >> Select form name.
3. Import CSV file Go To Admin >> Import CSV >> Import CSV tab >> Select form name.

== Installation ==

= Install via WordPress Admin =
1. Ready the zip file of the plugin
2. Go to Admin > Plugins > Add New
3. On the upper portion click the Upload link
4. Using the file upload field, upload the plugin zip file here and activate the plugin

= Install via FTP =
1. First, unzip the plugin file
2. Using FTP go to your server's wp-content/plugins directory
3. Upload the unzipped plugin here
4. Once finished login into your WP Admin and go to Admin > Plugins
5. Look for Advanced CF7 DB and activate it


== Frequently Asked Questions ==

= Can I use this plugin when contact form 7 not install or activate? =
No, without contact form this plugin is not worked.

= How can I import CSV sheet? =
First, you need to add CSV sheet related column name on Import CSV screen in the field setting tab and save values then import sheet on import CSV tab screen.

= Can I change the field name? =
No, You can change only field label name from Display settings screen.

= Any Difficulty to exported data in CSV? =
While exporting the data as CSV, the sheet needs to be opened with delimiter as "," comma separated else the sheet data will not be displayed properly. 

= What to do if advanced CF7 DB not work? =
If the plugin does not work on the website, contact our Support Team via following email address: <mehul@vsourz.com>.
If you think, that you found a bug in our plugin or have any question contact us at <mehul@vsourz.com>. Our support team will solve within 24 hours.

= Can I restrict the plugin from storing IP address of the user to contact form DB? =
Yes, you can strict the plugin for storing IP address of the user.

= How to restrict the plugin from storing IP address of the user to contact form DB? =
Restriction is simple, just code **do_shortcode( '[cf7-db-display-ip]' );** to be placed in theme folder functions.php. By placing the code the IP address of the user will not been stored. Step by step process is explained below :
- Goto -> wp-content/themes/{active theme folder}/functions.php
- Open the functions.php file and place the code **do_shortcode( '[cf7-db-display-ip]' );** at the end of the file.
**For Multisite** it should be **do_shortcode( '[cf7-db-display-ip site_id="(your-site-id)"]' );**
- You need to add different shortcode for each site with specific siteId. If you need to restrict for all the sites then just place the shortcode without the parameter.

= How to restrict the plugin from storing form entry to contact form DB? =
Restriction is simple, just following below steps :
- Goto -> wp-content/themes/{active theme folder}/functions.php
- Open the functions.php file and place below code at the end of the file.
add_filter('vsz_cf7_unwanted_form_data_submission','vsz_restrict_form_data_submission'); 
function vsz_restrict_form_data_submission($contact_form_ids){ 	
	$contact_form_ids[] = {your-contact-form-id}; 
	return $contact_form_ids;
}
**For multiple forms**
add_filter('vsz_cf7_unwanted_form_data_submission','vsz_restrict_form_data_submission'); 
function vsz_restrict_form_data_submission($contact_form_ids){ 	
	$contact_form_ids[] = ['{your-contact-form-id}','{your-contact-form-id}']; 
	return $contact_form_ids;
}


== Screenshots ==

1. Display form related records.
2. Display Setting popup screen.
3. Edit information popup screen.
4. Setup import file fields.
5. Import CSV file.


== Changelog ==

= 1.4.4 =
* Fixed issue related to export records in PDF.
* Provided filter for excluding particular contact form entry to the database
* Provided filter to add, modify, remove CF7 fields and data before submitting to the database.

= 1.4.3 =
* Fixed issue related to export records in PDF.
* Multisite support for IP restrict.

= 1.4.2 =
* Fixed issue related to hide ip address
* Delete attachment when record deleted
* Search with special characters issue fixed
* Accents and other languages special characters support added for export file with Excel and CSV
* Added the New library for the PDF


= 1.4.1 =
* Hidden field : Provision to update hidden field value.
* Export data in EXCEL : Resolved Special characters related issue.

= 1.4.0 =
* Export data in EXCEL & PDF file.
* IP address storage restriction.
* Mobile UI compatible
* **Schedule Report:** We have also introduced new feature **Schedule Report.**, now You can download our Commercial plugin from <a target="_blank" href="https://codecanyon.net/item/schedule-report-for-advanced-cf7-db/21560647?s_rank=8">here</a>

= 1.3.0 =
* Fixed issue related to the Contact Form tel field while editing the form data entry.
* Provision to change the number of records to be displayed in listing page from display setting option.
* Fixed issue related to redirection to the first page when a record is been updated from edit data popup.
* Compatible up to PHP 7.1

= 1.2.0 =
* Fix error related to PHP strings.

= 1.1.2 =
* Fix error related to PHP 7.1.

= 1.1.1 = 
* Made changes to resolve the issue of user feasibility when editing the form fields.
* Minor tweak related to export functionality and attachment download functionality.

= 1.1.0 = 
* Update Import Functionality.
* Fix CF7 Version related issue.

= 1.0.0 =
* Initial