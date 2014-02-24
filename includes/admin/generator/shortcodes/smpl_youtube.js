/**
 * Required arguments
 *  - id: Enter the Youtube video ID
 */
smplShortcodeAtts={
	attributes:[
		{
			label:"Video ID",
			id:"id",
			help:"Enter the Youtube video ID."
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
			label:"Show Info",
			id:"showinfo",
			help:"Displays video information.",
			controlType:"select-control",
			selectValues:['false', 'true']
		},
		{
			label:"Display Branding",
			id:"branding",
			help:"Show the YouTube logo from control bar",
			controlType:"select-control",
			selectValues:['false', 'true']
		},
		{
			label:"High Definition",
			id:"hd",
			help:"Force video to High Definition",
			controlType:"select-control",
			selectValues:['false', 'true']
		},
		{
			label:"Autoplay Video",
			id:"autoplay",
			help:"Start playing the video when the page loads",
			controlType:"select-control",
			selectValues:['false', 'true']
		},
		{
			label:"Show Controls",
			id:"controls",
			help:"Shows the video playbar",
			controlType:"select-control",
			selectValues:['false', 'true']
		},
		{
			label:"Theme",
			id:"theme",
			help:"Styles the player in a light or dark theme",
			controlType:"select-control",
			selectValues:['light', 'dark']
		},
	],
	defaultContent:"",
	shortcode:"youtube"
};