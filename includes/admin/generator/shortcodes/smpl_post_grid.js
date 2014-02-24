/**
 * Optional arguments
 * - categories: Categories to include, category slugs separated by commas (no spaces!), or blank for all categories
 * - columns: Number of posts per row
 * - rows: Number of rows
 * - orderby: date, title, comment_count, rand
 * - order: DESC, ASC
 * - offset: Number of posts to offset off the start, defaults to 0
 * - query: Custom query string
 * - link: Show link after posts, true or false
 * - link_text: Text for the link
 * - link_url: URL where link should go
 * - link_target: Where link opens - _self, _blank
 */
smplShortcodeAtts={
	attributes:[
		{
			label:"Columns",
			id:"cols",
			help:"Number of columns you'd like in the grid.",
			controlType:"select-control",
			selectValues:['1', '2', '3', '4']
		},
		{
			label:"Type",
			id:"type",
			help:"Display Pages or Posts",
			controlType:"select-control",
			selectValues:['post', 'page']
		},
		{
			label:"Number of posts to display.",
			id:"num",
			value:"10",
			help:"Number of posts you'd like to display."
		},
		{
			label:"Display Post Thumbnails",
			id:"thumbs",
			help:"Displays the featured image (if set in post).",
			controlType:"select-control",
			selectValues:['true', 'false']
		},
		//{
		//	label:"Thumbnail Width",
		//	id:"width",
		//	value:"",
		//	help:"Width of thumbnail images."
		//},
		//{
		//	label:"Thumbnail Height",
		//	id:"height",
		//	value:"",
		//	help:"Height of thumbnail images."
		//},
		{
			label:"Show Excerpts",
			id:"excerpt",
			help:"Display post excerpts.",
			controlType:"select-control",
			selectValues:['true', 'false']
		},
		{
			label:"Excerpt Length",
			id:"length",
			value:"55",
			help:"Enter the length (integer) of length to trim excerpt."
		},
		{
			label:"Read More button/link",
			id:"morelink",
			help:"Read more button link text. Leave empty to disable."
		},
		{
			label:"Categories",
			id:"cat",
			help:"List any category slugs you want to include (separated by commas)."
		},
		{
			label:"Tags",
			id:"tag",
			help:"List any tags you want to include (separated by commas)."
		},
		{
			label:"Order by",
			id:"orderby",
			help:"What to order the posts displayed by.",
			controlType:"select-control",
			selectValues:['date', 'title', 'comment_count', 'rand']
		},
		{
			label:"Order",
			id:"order",
			help:"How to order the posts displayed.",
			controlType:"select-control",
			selectValues:['DESC', 'ASC']
		},
		{
			label:"Offset",
			id:"offset",
			value:"0",
			help:"Number of posts to offset off the start, defaults to 0"
		}
	],
	defaultContent:"",
	shortcode:"latest"
};