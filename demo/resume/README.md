
简历数据存储在四个JavaScript对象中。正如通常情况下，利用API时，对象必须遵循的架构完全。所有属性必须存在并且具有真实或假的值。名称必须与架构中的那些匹配（注意对象和属性名称区分大小写）。所有属性值都应为架构中的属性所提供的数据类型。例如，如果将数据类型作为数组给出，则使用字符串作为该属性的值是不可接受的。
2。一旦你创建了JavaScript对象，你将编写代码来显示简历中包含的所有这些简历数据。
三.生成简历所需的所有HTML代码都存储在** /助手变量中。变量名称显示它们的功能。你会在这些变量替换子字符串值等数据为××%××和××××#与数据在你的JavaScript对象，并追加或预先格式化的结果，你的简历在合适的位置。

您的存储库将包括以下文件：
简单的HTML文档。包含所有需要渲染的简历的CSS和JS资源的链接，包括resumebuilder.js。
包含帮助格式化简历和生成地图所需的辅助代码。它也有一些功能壳额外的功能。在helper.js进一步下降。
*** js / resumebuilder。JS **：这个文件是空的。你应该在这里写代码。
***：* * *：jQuery库。
包含了CSS所需的所有CSS样式。
***自述文件：
GitHub的自述文件。
*和图像中的一些图像目录。
# #你的起点…
# # # js / helper.js
在helper.js，你会发现大量的HTML字符串包含片段。在多个片段中，您会发现占位符数据的格式为%数据%或%。
每个字符串都有一个标题，描述如何使用它。例如，` HTMLworkStart `应该是第一` <DIV> `在工作部分的恢复。` htmlschoollocation `包含` % % `数据占位符，应更换位置，你的学校。
# # #你的过程：
简历有四个不同的部分：工作，教育，项目和一个标题与传记资料。你需要：
1。建立四个JavaScript对象，每一个代表不同的恢复部分。您创建的对象（包括属性名称和它们的值的数据类型）需要遵循下面的模式。所有属性都应包含并包含指定类型的值，除非属性标记为“可选”。属性值可能包含实数据或伪数据。属性名称区分大小写。确保你的JavaScript对象的正确使用[ jshint格式化。COM ]（

属性名称区分大小写。
属性名是区分大小写的
