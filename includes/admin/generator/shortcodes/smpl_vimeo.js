/**
 * Required arguments
 *  - id: Enter the Vimeo video ID
 */

smplShortcodeAtts={
	attributes:[
		{
			label:"Video ID",
			id:"id",
			help:"Enter the Vimeo video ID."
		},
		{
			label:"Responsive Display",
			id:"responsive",
			help:"Displays video at full width in all browsers.",
			controlType:"select-control",
			selectValues:['true', 'false']
		},
		{
			label:"Width",
			id:"width",
			help:"Leave this blank if you have selected responsive."
		},
		{
			label:"Height",
			id:"height",
			help:"Leave this blank if you have selected responsive."
		},
		{
			label:"Center Video",
			id:"center",
			help:"Center the video on the page.",
			controlType:"select-control",
			selectValues:['false', 'true']
		},
	],
	defaultContent:"",
	shortcode:"vimeo"
};