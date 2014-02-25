/**
 * Optional arguments
 * - style: blue, green, grey, orange, purple, red, teal, yellow
 * - icon: Optional icon in upper left corner
 */

smplShortcodeAtts={
	attributes:[
		{
			label:"Style",
			id:"style",
			help:"Select the color of the callout box.",
			controlType:"select-control",
			selectValues:['black','white','blue','lightblue','darkblue','green','red','orange','pink','green']
		},
		{
			label:"Title",
			id:"title",
			help:"Enter a title to display. Leave blank for no title."
		},
		{
			label:"Center Title",
			id:"centertitle",
			help:"Center the title.",
			controlType:"select-control",
			selectValues:['true','false']
		},
		{
			label:"Align",
			id:"align",
			help:"Callout box alignment.",
			controlType:"select-control",
			selectValues:['center','left','right']
		},
		{
			label:"Width",
			id:"width",
			help:"Enter a CSS numeric value (px or %)"
		}
	],
	defaultContent:"Content Box Content...",
	shortcode:"callout"
};