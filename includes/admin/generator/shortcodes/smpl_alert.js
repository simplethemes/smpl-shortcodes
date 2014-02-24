/**
 * Optional arguments
 * - style: info, success, danger, message
 * - close: Show close button or not - true, false
 */
smplShortcodeAtts={
	attributes:[
		{
			label:"Style",
			id:"style",
			help:"Select the style of the alert.",
			controlType:"select-control",
			selectValues:['info','alert','warn','success','download','idea']
		},
		{
			label:"Show Icon",
			id:"show_icon",
			help:"Display the icon?",
			controlType:"select-control",
			selectValues:['true', 'false']
		}
	],
	defaultContent:"Content...",
	shortcode:"note"
};

