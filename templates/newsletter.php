<?php
$mail_template = <<<CONTENT
--[UID]
Content-Type: text/html; charset="UTF-8"
Content-Transfer-Encoding: 8bit

<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 15">
<meta name=Originator content="Microsoft Word 15">
<link rel=File-List href="newsletter-template-b_files/filelist.xml">
<link rel=Edit-Time-Data href="newsletter-template-b_files/editdata.mso">
<!--[if gte mso 9]><xml>
<o:OfficeDocumentSettings>
<o:AllowPNG/>
</o:OfficeDocumentSettings>
</xml><![endif]-->
<link rel=themeData href="newsletter-template-b_files/themedata.thmx">
<link rel=colorSchemeMapping
href="newsletter-template-b_files/colorschememapping.xml">
<!--[if gte mso 9]><xml>
<w:WordDocument>
<w:SpellingState>Clean</w:SpellingState>
<w:DocumentKind>DocumentEmail</w:DocumentKind>
<w:TrackMoves/>
<w:TrackFormatting/>
<w:PunctuationKerning/>
<w:ValidateAgainstSchemas/>
<w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>
<w:IgnoreMixedContent>false</w:IgnoreMixedContent>
<w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>
<w:DoNotPromoteQF/>
<w:LidThemeOther>EN-AU</w:LidThemeOther>
<w:LidThemeAsian>JA</w:LidThemeAsian>
<w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>
<w:Compatibility>
<w:DoNotExpandShiftReturn/>
<w:BreakWrappedTables/>
<w:SnapToGridInCell/>
<w:WrapTextWithPunct/>
<w:UseAsianBreakRules/>
<w:DontGrowAutofit/>
<w:SplitPgBreakAndParaMark/>
<w:EnableOpenTypeKerning/>
<w:DontFlipMirrorIndents/>
<w:OverrideTableStyleHps/>
<w:UseFELayout/>
</w:Compatibility>
<w:BrowserLevel>MicrosoftInternetExplorer4</w:BrowserLevel>
<m:mathPr>
<m:mathFont m:val="Cambria Math"/>
<m:brkBin m:val="before"/>
<m:brkBinSub m:val="&#45;-"/>
<m:smallFrac m:val="off"/>
<m:dispDef/>
<m:lMargin m:val="0"/>
<m:rMargin m:val="0"/>
<m:defJc m:val="centerGroup"/>
<m:wrapIndent m:val="1440"/>
<m:intLim m:val="subSup"/>
<m:naryLim m:val="undOvr"/>
</m:mathPr></w:WordDocument>
</xml><![endif]--><!--[if gte mso 9]><xml>
<w:LatentStyles DefLockedState="false" DefUnhideWhenUsed="false"
DefSemiHidden="false" DefQFormat="false" DefPriority="99"
LatentStyleCount="376">
<w:LsdException Locked="false" Priority="0" QFormat="true" Name="Normal"/>
<w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 1"/>
<w:LsdException Locked="false" Priority="9" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="heading 2"/>
<w:LsdException Locked="false" Priority="9" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="heading 3"/>
<w:LsdException Locked="false" Priority="9" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="heading 4"/>
<w:LsdException Locked="false" Priority="9" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="heading 5"/>
<w:LsdException Locked="false" Priority="9" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="heading 6"/>
<w:LsdException Locked="false" Priority="9" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="heading 7"/>
<w:LsdException Locked="false" Priority="9" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="heading 8"/>
<w:LsdException Locked="false" Priority="9" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="heading 9"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="index 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="index 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="index 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="index 4"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="index 5"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="index 6"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="index 7"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="index 8"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="index 9"/>
<w:LsdException Locked="false" Priority="39" SemiHidden="true"
UnhideWhenUsed="true" Name="toc 1"/>
<w:LsdException Locked="false" Priority="39" SemiHidden="true"
UnhideWhenUsed="true" Name="toc 2"/>
<w:LsdException Locked="false" Priority="39" SemiHidden="true"
UnhideWhenUsed="true" Name="toc 3"/>
<w:LsdException Locked="false" Priority="39" SemiHidden="true"
UnhideWhenUsed="true" Name="toc 4"/>
<w:LsdException Locked="false" Priority="39" SemiHidden="true"
UnhideWhenUsed="true" Name="toc 5"/>
<w:LsdException Locked="false" Priority="39" SemiHidden="true"
UnhideWhenUsed="true" Name="toc 6"/>
<w:LsdException Locked="false" Priority="39" SemiHidden="true"
UnhideWhenUsed="true" Name="toc 7"/>
<w:LsdException Locked="false" Priority="39" SemiHidden="true"
UnhideWhenUsed="true" Name="toc 8"/>
<w:LsdException Locked="false" Priority="39" SemiHidden="true"
UnhideWhenUsed="true" Name="toc 9"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Normal Indent"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="footnote text"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="annotation text"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="header"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="footer"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="index heading"/>
<w:LsdException Locked="false" Priority="35" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="caption"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="table of figures"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="envelope address"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="envelope return"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="footnote reference"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="annotation reference"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="line number"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="page number"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="endnote reference"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="endnote text"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="table of authorities"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="macro"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="toa heading"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Bullet"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Number"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List 4"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List 5"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Bullet 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Bullet 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Bullet 4"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Bullet 5"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Number 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Number 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Number 4"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Number 5"/>
<w:LsdException Locked="false" Priority="10" QFormat="true" Name="Title"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Closing"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Signature"/>
<w:LsdException Locked="false" Priority="1" SemiHidden="true"
UnhideWhenUsed="true" Name="Default Paragraph Font"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Body Text"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Body Text Indent"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Continue"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Continue 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Continue 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Continue 4"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="List Continue 5"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Message Header"/>
<w:LsdException Locked="false" Priority="11" QFormat="true" Name="Subtitle"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Salutation"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Date"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Body Text First Indent"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Body Text First Indent 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Note Heading"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Body Text 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Body Text 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Body Text Indent 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Body Text Indent 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Block Text"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Hyperlink"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="FollowedHyperlink"/>
<w:LsdException Locked="false" Priority="22" QFormat="true" Name="Strong"/>
<w:LsdException Locked="false" Priority="20" QFormat="true" Name="Emphasis"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Document Map"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Plain Text"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="E-mail Signature"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Top of Form"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Bottom of Form"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Normal (Web)"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Acronym"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Address"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Cite"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Code"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Definition"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Keyboard"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Preformatted"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Sample"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Typewriter"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="HTML Variable"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Normal Table"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="annotation subject"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="No List"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Outline List 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Outline List 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Outline List 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Simple 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Simple 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Simple 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Classic 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Classic 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Classic 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Classic 4"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Colorful 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Colorful 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Colorful 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Columns 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Columns 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Columns 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Columns 4"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Columns 5"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Grid 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Grid 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Grid 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Grid 4"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Grid 5"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Grid 6"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Grid 7"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Grid 8"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table List 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table List 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table List 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table List 4"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table List 5"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table List 6"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table List 7"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table List 8"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table 3D effects 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table 3D effects 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table 3D effects 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Contemporary"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Elegant"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Professional"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Subtle 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Subtle 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Web 1"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Web 2"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Web 3"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Balloon Text"/>
<w:LsdException Locked="false" Priority="39" Name="Table Grid"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Table Theme"/>
<w:LsdException Locked="false" SemiHidden="true" Name="Placeholder Text"/>
<w:LsdException Locked="false" Priority="1" QFormat="true" Name="No Spacing"/>
<w:LsdException Locked="false" Priority="60" Name="Light Shading"/>
<w:LsdException Locked="false" Priority="61" Name="Light List"/>
<w:LsdException Locked="false" Priority="62" Name="Light Grid"/>
<w:LsdException Locked="false" Priority="63" Name="Medium Shading 1"/>
<w:LsdException Locked="false" Priority="64" Name="Medium Shading 2"/>
<w:LsdException Locked="false" Priority="65" Name="Medium List 1"/>
<w:LsdException Locked="false" Priority="66" Name="Medium List 2"/>
<w:LsdException Locked="false" Priority="67" Name="Medium Grid 1"/>
<w:LsdException Locked="false" Priority="68" Name="Medium Grid 2"/>
<w:LsdException Locked="false" Priority="69" Name="Medium Grid 3"/>
<w:LsdException Locked="false" Priority="70" Name="Dark List"/>
<w:LsdException Locked="false" Priority="71" Name="Colorful Shading"/>
<w:LsdException Locked="false" Priority="72" Name="Colorful List"/>
<w:LsdException Locked="false" Priority="73" Name="Colorful Grid"/>
<w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 1"/>
<w:LsdException Locked="false" Priority="61" Name="Light List Accent 1"/>
<w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 1"/>
<w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 1"/>
<w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 1"/>
<w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 1"/>
<w:LsdException Locked="false" SemiHidden="true" Name="Revision"/>
<w:LsdException Locked="false" Priority="34" QFormat="true"
Name="List Paragraph"/>
<w:LsdException Locked="false" Priority="29" QFormat="true" Name="Quote"/>
<w:LsdException Locked="false" Priority="30" QFormat="true"
Name="Intense Quote"/>
<w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 1"/>
<w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 1"/>
<w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 1"/>
<w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 1"/>
<w:LsdException Locked="false" Priority="70" Name="Dark List Accent 1"/>
<w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 1"/>
<w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 1"/>
<w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 1"/>
<w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 2"/>
<w:LsdException Locked="false" Priority="61" Name="Light List Accent 2"/>
<w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 2"/>
<w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 2"/>
<w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 2"/>
<w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 2"/>
<w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 2"/>
<w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 2"/>
<w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 2"/>
<w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 2"/>
<w:LsdException Locked="false" Priority="70" Name="Dark List Accent 2"/>
<w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 2"/>
<w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 2"/>
<w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 2"/>
<w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 3"/>
<w:LsdException Locked="false" Priority="61" Name="Light List Accent 3"/>
<w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 3"/>
<w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 3"/>
<w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 3"/>
<w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 3"/>
<w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 3"/>
<w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 3"/>
<w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 3"/>
<w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 3"/>
<w:LsdException Locked="false" Priority="70" Name="Dark List Accent 3"/>
<w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 3"/>
<w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 3"/>
<w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 3"/>
<w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 4"/>
<w:LsdException Locked="false" Priority="61" Name="Light List Accent 4"/>
<w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 4"/>
<w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 4"/>
<w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 4"/>
<w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 4"/>
<w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 4"/>
<w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 4"/>
<w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 4"/>
<w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 4"/>
<w:LsdException Locked="false" Priority="70" Name="Dark List Accent 4"/>
<w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 4"/>
<w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 4"/>
<w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 4"/>
<w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 5"/>
<w:LsdException Locked="false" Priority="61" Name="Light List Accent 5"/>
<w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 5"/>
<w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 5"/>
<w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 5"/>
<w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 5"/>
<w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 5"/>
<w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 5"/>
<w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 5"/>
<w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 5"/>
<w:LsdException Locked="false" Priority="70" Name="Dark List Accent 5"/>
<w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 5"/>
<w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 5"/>
<w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 5"/>
<w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 6"/>
<w:LsdException Locked="false" Priority="61" Name="Light List Accent 6"/>
<w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 6"/>
<w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 6"/>
<w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 6"/>
<w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 6"/>
<w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 6"/>
<w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 6"/>
<w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 6"/>
<w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 6"/>
<w:LsdException Locked="false" Priority="70" Name="Dark List Accent 6"/>
<w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 6"/>
<w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 6"/>
<w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 6"/>
<w:LsdException Locked="false" Priority="19" QFormat="true"
Name="Subtle Emphasis"/>
<w:LsdException Locked="false" Priority="21" QFormat="true"
Name="Intense Emphasis"/>
<w:LsdException Locked="false" Priority="31" QFormat="true"
Name="Subtle Reference"/>
<w:LsdException Locked="false" Priority="32" QFormat="true"
Name="Intense Reference"/>
<w:LsdException Locked="false" Priority="33" QFormat="true" Name="Book Title"/>
<w:LsdException Locked="false" Priority="37" SemiHidden="true"
UnhideWhenUsed="true" Name="Bibliography"/>
<w:LsdException Locked="false" Priority="39" SemiHidden="true"
UnhideWhenUsed="true" QFormat="true" Name="TOC Heading"/>
<w:LsdException Locked="false" Priority="41" Name="Plain Table 1"/>
<w:LsdException Locked="false" Priority="42" Name="Plain Table 2"/>
<w:LsdException Locked="false" Priority="43" Name="Plain Table 3"/>
<w:LsdException Locked="false" Priority="44" Name="Plain Table 4"/>
<w:LsdException Locked="false" Priority="45" Name="Plain Table 5"/>
<w:LsdException Locked="false" Priority="40" Name="Grid Table Light"/>
<w:LsdException Locked="false" Priority="46" Name="Grid Table 1 Light"/>
<w:LsdException Locked="false" Priority="47" Name="Grid Table 2"/>
<w:LsdException Locked="false" Priority="48" Name="Grid Table 3"/>
<w:LsdException Locked="false" Priority="49" Name="Grid Table 4"/>
<w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark"/>
<w:LsdException Locked="false" Priority="51" Name="Grid Table 6 Colorful"/>
<w:LsdException Locked="false" Priority="52" Name="Grid Table 7 Colorful"/>
<w:LsdException Locked="false" Priority="46"
Name="Grid Table 1 Light Accent 1"/>
<w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 1"/>
<w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 1"/>
<w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 1"/>
<w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 1"/>
<w:LsdException Locked="false" Priority="51"
Name="Grid Table 6 Colorful Accent 1"/>
<w:LsdException Locked="false" Priority="52"
Name="Grid Table 7 Colorful Accent 1"/>
<w:LsdException Locked="false" Priority="46"
Name="Grid Table 1 Light Accent 2"/>
<w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 2"/>
<w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 2"/>
<w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 2"/>
<w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 2"/>
<w:LsdException Locked="false" Priority="51"
Name="Grid Table 6 Colorful Accent 2"/>
<w:LsdException Locked="false" Priority="52"
Name="Grid Table 7 Colorful Accent 2"/>
<w:LsdException Locked="false" Priority="46"
Name="Grid Table 1 Light Accent 3"/>
<w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 3"/>
<w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 3"/>
<w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 3"/>
<w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 3"/>
<w:LsdException Locked="false" Priority="51"
Name="Grid Table 6 Colorful Accent 3"/>
<w:LsdException Locked="false" Priority="52"
Name="Grid Table 7 Colorful Accent 3"/>
<w:LsdException Locked="false" Priority="46"
Name="Grid Table 1 Light Accent 4"/>
<w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 4"/>
<w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 4"/>
<w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 4"/>
<w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 4"/>
<w:LsdException Locked="false" Priority="51"
Name="Grid Table 6 Colorful Accent 4"/>
<w:LsdException Locked="false" Priority="52"
Name="Grid Table 7 Colorful Accent 4"/>
<w:LsdException Locked="false" Priority="46"
Name="Grid Table 1 Light Accent 5"/>
<w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 5"/>
<w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 5"/>
<w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 5"/>
<w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 5"/>
<w:LsdException Locked="false" Priority="51"
Name="Grid Table 6 Colorful Accent 5"/>
<w:LsdException Locked="false" Priority="52"
Name="Grid Table 7 Colorful Accent 5"/>
<w:LsdException Locked="false" Priority="46"
Name="Grid Table 1 Light Accent 6"/>
<w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 6"/>
<w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 6"/>
<w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 6"/>
<w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 6"/>
<w:LsdException Locked="false" Priority="51"
Name="Grid Table 6 Colorful Accent 6"/>
<w:LsdException Locked="false" Priority="52"
Name="Grid Table 7 Colorful Accent 6"/>
<w:LsdException Locked="false" Priority="46" Name="List Table 1 Light"/>
<w:LsdException Locked="false" Priority="47" Name="List Table 2"/>
<w:LsdException Locked="false" Priority="48" Name="List Table 3"/>
<w:LsdException Locked="false" Priority="49" Name="List Table 4"/>
<w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark"/>
<w:LsdException Locked="false" Priority="51" Name="List Table 6 Colorful"/>
<w:LsdException Locked="false" Priority="52" Name="List Table 7 Colorful"/>
<w:LsdException Locked="false" Priority="46"
Name="List Table 1 Light Accent 1"/>
<w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 1"/>
<w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 1"/>
<w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 1"/>
<w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 1"/>
<w:LsdException Locked="false" Priority="51"
Name="List Table 6 Colorful Accent 1"/>
<w:LsdException Locked="false" Priority="52"
Name="List Table 7 Colorful Accent 1"/>
<w:LsdException Locked="false" Priority="46"
Name="List Table 1 Light Accent 2"/>
<w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 2"/>
<w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 2"/>
<w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 2"/>
<w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 2"/>
<w:LsdException Locked="false" Priority="51"
Name="List Table 6 Colorful Accent 2"/>
<w:LsdException Locked="false" Priority="52"
Name="List Table 7 Colorful Accent 2"/>
<w:LsdException Locked="false" Priority="46"
Name="List Table 1 Light Accent 3"/>
<w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 3"/>
<w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 3"/>
<w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 3"/>
<w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 3"/>
<w:LsdException Locked="false" Priority="51"
Name="List Table 6 Colorful Accent 3"/>
<w:LsdException Locked="false" Priority="52"
Name="List Table 7 Colorful Accent 3"/>
<w:LsdException Locked="false" Priority="46"
Name="List Table 1 Light Accent 4"/>
<w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 4"/>
<w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 4"/>
<w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 4"/>
<w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 4"/>
<w:LsdException Locked="false" Priority="51"
Name="List Table 6 Colorful Accent 4"/>
<w:LsdException Locked="false" Priority="52"
Name="List Table 7 Colorful Accent 4"/>
<w:LsdException Locked="false" Priority="46"
Name="List Table 1 Light Accent 5"/>
<w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 5"/>
<w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 5"/>
<w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 5"/>
<w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 5"/>
<w:LsdException Locked="false" Priority="51"
Name="List Table 6 Colorful Accent 5"/>
<w:LsdException Locked="false" Priority="52"
Name="List Table 7 Colorful Accent 5"/>
<w:LsdException Locked="false" Priority="46"
Name="List Table 1 Light Accent 6"/>
<w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 6"/>
<w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 6"/>
<w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 6"/>
<w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 6"/>
<w:LsdException Locked="false" Priority="51"
Name="List Table 6 Colorful Accent 6"/>
<w:LsdException Locked="false" Priority="52"
Name="List Table 7 Colorful Accent 6"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Mention"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Smart Hyperlink"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Hashtag"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Unresolved Mention"/>
<w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
Name="Smart Link"/>
</w:LatentStyles>
</xml><![endif]-->
<style>
<!--
/* Font Definitions */
@font-face
{font-family:Wingdings;
panose-1:5 0 0 0 0 0 0 0 0 0;
mso-font-charset:2;
mso-generic-font-family:auto;
mso-font-pitch:variable;
mso-font-signature:0 268435456 0 0 -2147483648 0;}
@font-face
{font-family:"Cambria Math";
panose-1:2 4 5 3 5 4 6 3 2 4;
mso-font-charset:0;
mso-generic-font-family:roman;
mso-font-pitch:variable;
mso-font-signature:-536869121 1107305727 33554432 0 415 0;}
@font-face
{font-family:"Yu Gothic";
panose-1:2 11 4 0 0 0 0 0 0 0;
mso-font-alt:游ゴシック;
mso-font-charset:128;
mso-generic-font-family:swiss;
mso-font-pitch:variable;
mso-font-signature:-536870145 717749759 22 0 131231 0;}
@font-face
{font-family:Calibri;
panose-1:2 15 5 2 2 2 4 3 2 4;
mso-font-charset:0;
mso-generic-font-family:swiss;
mso-font-pitch:variable;
mso-font-signature:-469750017 -1073732485 9 0 511 0;}
@font-face
{font-family:VIC;
panose-1:0 0 5 0 0 0 0 0 0 0;
mso-font-charset:0;
mso-generic-font-family:auto;
mso-font-pitch:variable;
mso-font-signature:7 0 0 0 147 0;}
@font-face
{font-family:"\@Yu Gothic";
panose-1:2 11 4 0 0 0 0 0 0 0;
mso-font-charset:128;
mso-generic-font-family:swiss;
mso-font-pitch:variable;
mso-font-signature:-536870145 717749759 22 0 131231 0;}
@font-face
{font-family:Montserrat;
panose-1:0 0 5 0 0 0 0 0 0 0;
mso-font-charset:0;
mso-generic-font-family:auto;
mso-font-pitch:variable;
mso-font-signature:536871439 3 0 0 407 0;}
/* Style Definitions */
p.MsoNormal, li.MsoNormal, div.MsoNormal
{mso-style-unhide:no;
mso-style-qformat:yes;
mso-style-parent:"";
margin:0cm;
margin-bottom:.0001pt;
mso-pagination:widow-orphan;
font-size:11.0pt;
font-family:"Calibri",sans-serif;
mso-ascii-font-family:Calibri;
mso-ascii-theme-font:minor-latin;
mso-fareast-font-family:"Yu Gothic";
mso-fareast-theme-font:minor-fareast;
mso-hansi-font-family:Calibri;
mso-hansi-theme-font:minor-latin;
mso-bidi-font-family:"Times New Roman";
mso-bidi-theme-font:minor-bidi;}
h2
{mso-style-noshow:yes;
mso-style-priority:9;
mso-style-qformat:yes;
mso-style-link:"Heading 2 Char";
mso-margin-top-alt:auto;
margin-right:0cm;
mso-margin-bottom-alt:auto;
margin-left:0cm;
mso-pagination:widow-orphan;
mso-outline-level:2;
font-size:18.0pt;
font-family:"Calibri",sans-serif;
mso-fareast-font-family:"Times New Roman";
font-weight:bold;}
h3
{mso-style-noshow:yes;
mso-style-priority:9;
mso-style-qformat:yes;
mso-style-link:"Heading 3 Char";
mso-style-next:Normal;
margin-top:2.0pt;
margin-right:0cm;
margin-bottom:0cm;
margin-left:0cm;
margin-bottom:.0001pt;
mso-pagination:widow-orphan lines-together;
page-break-after:avoid;
mso-outline-level:3;
font-size:12.0pt;
font-family:"Calibri Light",sans-serif;
mso-ascii-font-family:"Calibri Light";
mso-ascii-theme-font:major-latin;
mso-fareast-font-family:"Yu Gothic Light";
mso-fareast-theme-font:major-fareast;
mso-hansi-font-family:"Calibri Light";
mso-hansi-theme-font:major-latin;
mso-bidi-font-family:"Times New Roman";
mso-bidi-theme-font:major-bidi;
color:#1F3763;
mso-themecolor:accent1;
mso-themeshade:127;
font-weight:normal;}
a:link, span.MsoHyperlink
{mso-style-noshow:yes;
mso-style-priority:99;
color:#0563C1;
mso-themecolor:hyperlink;
text-decoration:underline;
text-underline:single;}
a:visited, span.MsoHyperlinkFollowed
{mso-style-noshow:yes;
mso-style-priority:99;
color:#954F72;
mso-themecolor:followedhyperlink;
text-decoration:underline;
text-underline:single;}
p
{mso-style-noshow:yes;
mso-style-priority:99;
mso-margin-top-alt:auto;
margin-right:0cm;
mso-margin-bottom-alt:auto;
margin-left:0cm;
mso-pagination:widow-orphan;
font-size:11.0pt;
font-family:"Calibri",sans-serif;
mso-fareast-font-family:"Yu Gothic";
mso-fareast-theme-font:minor-fareast;}
span.Heading2Char
{mso-style-name:"Heading 2 Char";
mso-style-noshow:yes;
mso-style-priority:9;
mso-style-unhide:no;
mso-style-locked:yes;
mso-style-link:"Heading 2";
mso-ansi-font-size:18.0pt;
mso-bidi-font-size:18.0pt;
font-family:"Calibri",sans-serif;
mso-ascii-font-family:Calibri;
mso-fareast-font-family:"Times New Roman";
mso-hansi-font-family:Calibri;
mso-bidi-font-family:Calibri;
font-weight:bold;}
span.Heading3Char
{mso-style-name:"Heading 3 Char";
mso-style-noshow:yes;
mso-style-priority:9;
mso-style-unhide:no;
mso-style-locked:yes;
mso-style-link:"Heading 3";
mso-ansi-font-size:12.0pt;
mso-bidi-font-size:12.0pt;
font-family:"Calibri Light",sans-serif;
mso-ascii-font-family:"Calibri Light";
mso-ascii-theme-font:major-latin;
mso-fareast-font-family:"Yu Gothic Light";
mso-fareast-theme-font:major-fareast;
mso-hansi-font-family:"Calibri Light";
mso-hansi-theme-font:major-latin;
mso-bidi-font-family:"Times New Roman";
mso-bidi-theme-font:major-bidi;
color:#1F3763;
mso-themecolor:accent1;
mso-themeshade:127;}
p.msonormal0, li.msonormal0, div.msonormal0
{mso-style-name:msonormal;
mso-style-unhide:no;
mso-margin-top-alt:auto;
margin-right:0cm;
mso-margin-bottom-alt:auto;
margin-left:0cm;
mso-pagination:widow-orphan;
font-size:11.0pt;
font-family:"Calibri",sans-serif;
mso-fareast-font-family:"Yu Gothic";
mso-fareast-theme-font:minor-fareast;}
span.EmailStyle20
{mso-style-type:personal-compose;
mso-style-noshow:yes;
mso-style-unhide:no;
mso-ansi-font-size:10.0pt;
mso-bidi-font-size:11.0pt;
font-family:VIC;
mso-ascii-font-family:VIC;
mso-fareast-font-family:"Yu Gothic";
mso-fareast-theme-font:minor-fareast;
mso-hansi-font-family:VIC;
mso-bidi-font-family:"Times New Roman";
mso-bidi-theme-font:minor-bidi;
color:#7F7F7F;
mso-themecolor:text1;
mso-themetint:128;
font-weight:normal;
font-style:normal;}
span.subheading
{mso-style-name:subheading;
mso-style-unhide:no;}
span.SpellE
{mso-style-name:"";
mso-spl-e:yes;}
.MsoChpDefault
{mso-style-type:export-only;
mso-default-props:yes;
font-size:10.0pt;
mso-ansi-font-size:10.0pt;
mso-bidi-font-size:10.0pt;
font-family:"Calibri",sans-serif;
mso-ascii-font-family:Calibri;
mso-ascii-theme-font:minor-latin;
mso-fareast-font-family:"Yu Gothic";
mso-fareast-theme-font:minor-fareast;
mso-hansi-font-family:Calibri;
mso-hansi-theme-font:minor-latin;
mso-bidi-font-family:"Times New Roman";
mso-bidi-theme-font:minor-bidi;}
@page WordSection1
{size:612.0pt 792.0pt;
margin:72.0pt 72.0pt 72.0pt 72.0pt;
mso-header-margin:36.0pt;
mso-footer-margin:36.0pt;
mso-paper-source:0;}
div.WordSection1
{page:WordSection1;}
/* List Definitions */
@list l0
{mso-list-id:128668093;
mso-list-template-ids:-338769990;}
@list l0:level1
{mso-level-number-format:bullet;
mso-level-text:;
mso-level-tab-stop:36.0pt;
mso-level-number-position:left;
text-indent:-18.0pt;
mso-ansi-font-size:10.0pt;
font-family:Symbol;}
@list l0:level2
{mso-level-number-format:bullet;
mso-level-text:o;
mso-level-tab-stop:72.0pt;
mso-level-number-position:left;
text-indent:-18.0pt;
mso-ansi-font-size:10.0pt;
font-family:"Courier New";
mso-bidi-font-family:"Times New Roman";}
@list l0:level3
{mso-level-number-format:bullet;
mso-level-text:;
mso-level-tab-stop:108.0pt;
mso-level-number-position:left;
text-indent:-18.0pt;
mso-ansi-font-size:10.0pt;
font-family:Wingdings;}
@list l0:level4
{mso-level-number-format:bullet;
mso-level-text:;
mso-level-tab-stop:144.0pt;
mso-level-number-position:left;
text-indent:-18.0pt;
mso-ansi-font-size:10.0pt;
font-family:Wingdings;}
@list l0:level5
{mso-level-number-format:bullet;
mso-level-text:;
mso-level-tab-stop:180.0pt;
mso-level-number-position:left;
text-indent:-18.0pt;
mso-ansi-font-size:10.0pt;
font-family:Wingdings;}
@list l0:level6
{mso-level-number-format:bullet;
mso-level-text:;
mso-level-tab-stop:216.0pt;
mso-level-number-position:left;
text-indent:-18.0pt;
mso-ansi-font-size:10.0pt;
font-family:Wingdings;}
@list l0:level7
{mso-level-number-format:bullet;
mso-level-text:;
mso-level-tab-stop:252.0pt;
mso-level-number-position:left;
text-indent:-18.0pt;
mso-ansi-font-size:10.0pt;
font-family:Wingdings;}
@list l0:level8
{mso-level-number-format:bullet;
mso-level-text:;
mso-level-tab-stop:288.0pt;
mso-level-number-position:left;
text-indent:-18.0pt;
mso-ansi-font-size:10.0pt;
font-family:Wingdings;}
@list l0:level9
{mso-level-number-format:bullet;
mso-level-text:;
mso-level-tab-stop:324.0pt;
mso-level-number-position:left;
text-indent:-18.0pt;
mso-ansi-font-size:10.0pt;
font-family:Wingdings;}
@list l1
{mso-list-id:1912233244;
mso-list-template-ids:-1482366306;}
@list l1:level1
{mso-level-number-format:bullet;
mso-level-text:;
mso-level-tab-stop:36.0pt;
mso-level-number-position:left;
text-indent:-18.0pt;
mso-ansi-font-size:10.0pt;
font-family:Symbol;}
@list l1:level2
{mso-level-number-format:bullet;
mso-level-text:;
mso-level-tab-stop:72.0pt;
mso-level-number-position:left;
text-indent:-18.0pt;
mso-ansi-font-size:10.0pt;
font-family:Symbol;}
@list l1:level3
{mso-level-number-format:bullet;
mso-level-text:;
mso-level-tab-stop:108.0pt;
mso-level-number-position:left;
text-indent:-18.0pt;
mso-ansi-font-size:10.0pt;
font-family:Symbol;}
@list l1:level4
{mso-level-number-format:bullet;
mso-level-text:;
mso-level-tab-stop:144.0pt;
mso-level-number-position:left;
text-indent:-18.0pt;
mso-ansi-font-size:10.0pt;
font-family:Symbol;}
@list l1:level5
{mso-level-number-format:bullet;
mso-level-text:;
mso-level-tab-stop:180.0pt;
mso-level-number-position:left;
text-indent:-18.0pt;
mso-ansi-font-size:10.0pt;
font-family:Symbol;}
@list l1:level6
{mso-level-number-format:bullet;
mso-level-text:;
mso-level-tab-stop:216.0pt;
mso-level-number-position:left;
text-indent:-18.0pt;
mso-ansi-font-size:10.0pt;
font-family:Symbol;}
@list l1:level7
{mso-level-number-format:bullet;
mso-level-text:;
mso-level-tab-stop:252.0pt;
mso-level-number-position:left;
text-indent:-18.0pt;
mso-ansi-font-size:10.0pt;
font-family:Symbol;}
@list l1:level8
{mso-level-number-format:bullet;
mso-level-text:;
mso-level-tab-stop:288.0pt;
mso-level-number-position:left;
text-indent:-18.0pt;
mso-ansi-font-size:10.0pt;
font-family:Symbol;}
@list l1:level9
{mso-level-number-format:bullet;
mso-level-text:;
mso-level-tab-stop:324.0pt;
mso-level-number-position:left;
text-indent:-18.0pt;
mso-ansi-font-size:10.0pt;
font-family:Symbol;}
ol
{margin-bottom:0cm;}
ul
{margin-bottom:0cm;}
-->
</style>
<!--[if gte mso 10]>
<style>
/* Style Definitions */
table.MsoNormalTable
{mso-style-name:"Table Normal";
mso-tstyle-rowband-size:0;
mso-tstyle-colband-size:0;
mso-style-noshow:yes;
mso-style-priority:99;
mso-style-parent:"";
mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
mso-para-margin:0cm;
mso-para-margin-bottom:.0001pt;
mso-pagination:widow-orphan;
font-size:10.0pt;
font-family:"Calibri",sans-serif;
mso-ascii-font-family:Calibri;
mso-ascii-theme-font:minor-latin;
mso-hansi-font-family:Calibri;
mso-hansi-theme-font:minor-latin;
mso-bidi-font-family:"Times New Roman";
mso-bidi-theme-font:minor-bidi;}
table.MsoTableGrid
{mso-style-name:"Table Grid";
mso-tstyle-rowband-size:0;
mso-tstyle-colband-size:0;
mso-style-priority:39;
mso-style-unhide:no;
border:solid windowtext 1.0pt;
mso-border-alt:solid windowtext .5pt;
mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
mso-border-insideh:.5pt solid windowtext;
mso-border-insidev:.5pt solid windowtext;
mso-para-margin:0cm;
mso-para-margin-bottom:.0001pt;
mso-pagination:widow-orphan;
font-size:11.0pt;
font-family:"Calibri",sans-serif;
mso-ascii-font-family:Calibri;
mso-ascii-theme-font:minor-latin;
mso-hansi-font-family:Calibri;
mso-hansi-theme-font:minor-latin;
mso-bidi-font-family:"Times New Roman";
mso-bidi-theme-font:minor-bidi;}
</style>
<![endif]--><!--[if gte mso 9]><xml>
<o:shapedefaults v:ext="edit" spidmax="1026"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
<o:shapelayout v:ext="edit">
<o:idmap v:ext="edit" data="1"/>
</o:shapelayout></xml><![endif]-->
</head>
<body bgcolor="#E7E6E6" lang=EN-AU link="#0563C1" vlink="#954F72"
style='tab-interval:36.0pt'>
<div class=WordSection1>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 align=left
style='border-collapse:collapse;border:none;mso-yfti-tbllook:1184;mso-table-lspace:
9.0pt;margin-left:6.75pt;mso-table-rspace:9.0pt;margin-right:6.75pt;
mso-table-anchor-vertical:margin;mso-table-anchor-horizontal:margin;
mso-table-left:left;mso-table-top:-11.25pt;mso-padding-alt:0cm 14.2pt 0cm 14.2pt;
mso-border-insideh:none;mso-border-insidev:none'>
<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
<td width=623 valign=top style='width:467.5pt;background:white;mso-background-themecolor:
background1;padding:0cm 14.2pt 0cm 14.2pt'>
<p class=MsoNormal align=center style='margin-top:16.0pt;margin-right:0cm;
margin-bottom:16.0pt;margin-left:0cm;text-align:center;mso-element:frame;
mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:
margin;mso-element-top:-11.25pt;mso-height-rule:exactly'><b><span
style='font-size:16.0pt;font-family:Montserrat;mso-fareast-font-family:"Times New Roman";
color:#FF9933'><a href="https://www.simpleprogramming.com.au/"><span
style='color:#FF9933;text-decoration:none;text-underline:none'>SIMPLE
PROGRAMMING</span></a></span></b><b><span style='font-size:18.0pt;font-family:
Montserrat;color:#FF9933'><o:p></o:p></span></b></p>
</td>
</tr>
<tr style='mso-yfti-irow:1'>
<td width=623 valign=top style='width:467.5pt;background:black;mso-background-themecolor:
text1;padding:0cm 14.2pt 0cm 14.2pt'>
<h2 align=center style='margin-top:18.0pt;margin-right:0cm;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:center;background:black;
mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:around;
mso-element-anchor-horizontal:margin;mso-element-top:-11.25pt;mso-height-rule:
exactly'><span style='font-size:22.5pt;font-family:Montserrat;color:white'>Hi
[CONTACT_NAME]<o:p></o:p></span></h2>
<p align=center style='text-align:center;background:black;mso-element:frame;
mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:
margin;mso-element-top:-11.25pt;mso-height-rule:exactly;text-size-adjust: 100%;
color:rgba(255, 255, 255, 0.8);font-variant-ligatures: normal;font-variant-caps: normal;
orphans: 2;widows: 2;-webkit-text-stroke-width: 0px;text-decoration-style: initial;
text-decoration-color: initial;word-spacing:0px'><span style='font-size:11.5pt;
font-family:Montserrat;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:
minor-bidi;color:white;mso-color-alt:windowtext'>Your <span class=SpellE>CovidVault</span>
usage for [MONTH], [YEAR] was</span><span style='font-size:11.5pt;font-family:
Montserrat;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:minor-bidi'><o:p></o:p></span></p>
<p align=center style='text-align:center;background:black;mso-element:frame;
mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:
margin;mso-element-top:-11.25pt;mso-height-rule:exactly;text-size-adjust: 100%;
color:rgba(255, 255, 255, 0.8);font-variant-ligatures: normal;font-variant-caps: normal;
orphans: 2;widows: 2;-webkit-text-stroke-width: 0px;text-decoration-style: initial;
text-decoration-color: initial;word-spacing:0px'><b><span style='font-size:
14.0pt;font-family:Montserrat;mso-bidi-font-family:"Times New Roman";
mso-bidi-theme-font:minor-bidi;color:white;mso-themecolor:background1'>[REQUESTS]<o:p></o:p></span></b></p>
<p align=center style='text-align:center;background:black;mso-element:frame;
mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:
margin;mso-element-top:-11.25pt;mso-height-rule:exactly'><span
style='font-size:11.5pt;font-family:Montserrat;mso-bidi-font-family:"Times New Roman";
mso-bidi-theme-font:minor-bidi;color:white;mso-color-alt:windowtext'>This is
[FREE_PERCENTAGE]% of the free tier.</span><span style='font-size:11.5pt;
font-family:Montserrat;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:
minor-bidi'><o:p></o:p></span></p>
<p align=center style='text-align:center;background:black;mso-element:frame;
mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:
margin;mso-element-top:-11.25pt;mso-height-rule:exactly;text-size-adjust: 100%;
color:rgba(255, 255, 255, 0.8);font-variant-ligatures: normal;font-variant-caps: normal;
orphans: 2;widows: 2;-webkit-text-stroke-width: 0px;text-decoration-style: initial;
text-decoration-color: initial;word-spacing:0px'><span style='font-size:11.5pt;
font-family:Montserrat;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:
minor-bidi;color:white;mso-color-alt:windowtext'>If payment is required, we
will be in touch shortly to discuss invoicing and payment options.</span><span
style='font-size:11.5pt;font-family:Montserrat;mso-bidi-font-family:"Times New Roman";
mso-bidi-theme-font:minor-bidi'><o:p></o:p></span></p>
<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:around;
mso-element-anchor-horizontal:margin;mso-element-top:-11.25pt;mso-height-rule:
exactly'><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:
VIC;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'><o:p>&nbsp;</o:p></span></p>
</td>
</tr>
<tr style='mso-yfti-irow:2'>
<td width=623 valign=top style='width:467.5pt;background:#595959;mso-background-themecolor:
text1;mso-background-themetint:166;padding:0cm 14.2pt 0cm 14.2pt'>
<div style='mso-element:para-border-div;border:none;border-bottom:solid #FF9933 1.5pt;
padding:0cm 0cm 1.0pt 0cm'>
<p class=MsoNormal align=center style='margin-top:18.0pt;margin-right:0cm;
margin-bottom:6.0pt;margin-left:0cm;text-align:center;border:none;mso-border-bottom-alt:
solid #FF9933 1.5pt;padding:0cm;mso-padding-alt:0cm 0cm 1.0pt 0cm;mso-element:
frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:
margin;mso-element-top:-11.25pt;mso-height-rule:exactly'><b><span
style='font-size:10.0pt;font-family:Montserrat;mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:Calibri;color:white;mso-themecolor:background1;
text-transform:uppercase;letter-spacing:1.5pt'>NEWS</span></b><b><span
style='mso-ascii-font-family:Calibri;mso-fareast-font-family:"Times New Roman";
mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri;color:white;
mso-themecolor:background1'><o:p></o:p></span></b></p>
</div>
<p class=MsoNormal align=center style='mso-margin-bottom-alt:auto;text-align:
center;mso-outline-level:2;mso-element:frame;mso-element-frame-hspace:9.0pt;
mso-element-wrap:around;mso-element-anchor-horizontal:margin;mso-element-top:
-11.25pt;mso-height-rule:exactly'><span class=SpellE><b><span
style='font-size:21.0pt;font-family:Montserrat;mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:Calibri;color:white;mso-themecolor:background1'>CovidVault</span></b></span><b><span
style='font-size:21.0pt;font-family:Montserrat;mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:Calibri;color:white;mso-themecolor:background1'> Updates<o:p></o:p></span></b></p>
<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:around;
mso-element-anchor-horizontal:margin;mso-element-top:-11.25pt;mso-height-rule:
exactly'><span style='font-size:11.5pt;font-family:Montserrat;mso-fareast-font-family:
"Times New Roman";mso-bidi-font-family:Calibri;color:white;mso-themecolor:
background1'>In [MONTH], <span class=SpellE>CovidVault</span> received
several updates:<o:p></o:p></span></p>
<ul type=disc>
<li class=MsoNormal style='color:white;mso-themecolor:background1;
mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;mso-list:l0 level1 lfo3;
tab-stops:list 36.0pt;mso-element:frame;mso-element-frame-hspace:9.0pt;
mso-element-wrap:around;mso-element-anchor-horizontal:margin;mso-element-top:
-11.25pt;mso-height-rule:exactly'><span style='font-size:11.5pt;
font-family:Montserrat;mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:Calibri'>The analytics page has been restored to
the dashboard<o:p></o:p></span></li>
<li class=MsoNormal style='color:white;mso-themecolor:background1;
mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;mso-list:l0 level1 lfo3;
tab-stops:list 36.0pt;mso-element:frame;mso-element-frame-hspace:9.0pt;
mso-element-wrap:around;mso-element-anchor-horizontal:margin;mso-element-top:
-11.25pt;mso-height-rule:exactly'><span style='font-size:11.5pt;
font-family:Montserrat;mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:Calibri'>Your usage can now be tracked via the
analytics page<o:p></o:p></span></li>
<li class=MsoNormal style='color:white;mso-themecolor:background1;
mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;mso-list:l0 level1 lfo3;
tab-stops:list 36.0pt;mso-element:frame;mso-element-frame-hspace:9.0pt;
mso-element-wrap:around;mso-element-anchor-horizontal:margin;mso-element-top:
-11.25pt;mso-height-rule:exactly'><span style='font-size:11.5pt;
font-family:Montserrat;mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:Calibri'>Manual data entry has been restored to the
dashboard<o:p></o:p></span></li>
<li class=MsoNormal style='color:white;mso-themecolor:background1;
mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;mso-list:l0 level1 lfo3;
tab-stops:list 36.0pt;mso-element:frame;mso-element-frame-hspace:9.0pt;
mso-element-wrap:around;mso-element-anchor-horizontal:margin;mso-element-top:
-11.25pt;mso-height-rule:exactly'><span style='font-size:11.5pt;
font-family:Montserrat;mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:Calibri'>Conditions of entry can be added via the
dashboard<o:p></o:p></span></li>
<li class=MsoNormal style='color:white;mso-themecolor:background1;
mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;mso-list:l0 level1 lfo3;
tab-stops:list 36.0pt;mso-element:frame;mso-element-frame-hspace:9.0pt;
mso-element-wrap:around;mso-element-anchor-horizontal:margin;mso-element-top:
-11.25pt;mso-height-rule:exactly'><span style='font-size:11.5pt;
font-family:Montserrat;mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:Calibri'>A link to your check-in page has been
added to the dashboard menu<o:p></o:p></span></li>
<li class=MsoNormal style='color:white;mso-themecolor:background1;
mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;mso-list:l0 level1 lfo3;
tab-stops:list 36.0pt;mso-element:frame;mso-element-frame-hspace:9.0pt;
mso-element-wrap:around;mso-element-anchor-horizontal:margin;mso-element-top:
-11.25pt;mso-height-rule:exactly'><span style='font-size:11.5pt;
font-family:Montserrat;mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:Calibri'>Forgotten passwords can now be restored
via the dashboard login screen<o:p></o:p></span></li>
<li class=MsoNormal style='color:white;mso-themecolor:background1;
mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;mso-list:l0 level1 lfo3;
tab-stops:list 36.0pt;mso-element:frame;mso-element-frame-hspace:9.0pt;
mso-element-wrap:around;mso-element-anchor-horizontal:margin;mso-element-top:
-11.25pt;mso-height-rule:exactly'><span style='font-size:11.5pt;
font-family:Montserrat;mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:Calibri'>Wide logos no longer <span class=SpellE>spillover</span>
the border of the check-in screen.<o:p></o:p></span></li>
</ul>
<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:around;
mso-element-anchor-horizontal:margin;mso-element-top:-11.25pt;mso-height-rule:
exactly'><span style='font-size:11.5pt;font-family:Montserrat;mso-fareast-font-family:
"Times New Roman";mso-bidi-font-family:Calibri;color:white;mso-themecolor:
background1'>I look forward to releasing more incremental updates throughout
the following month.<o:p></o:p></span></p>
<p class=MsoNormal align=center style='text-align:center;mso-element:frame;
mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:
margin;mso-element-top:-11.25pt;mso-height-rule:exactly'><span
style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:VIC;color:#7F7F7F;
mso-themecolor:text1;mso-themetint:128'><o:p>&nbsp;</o:p></span></p>
</td>
</tr>
<tr style='mso-yfti-irow:3'>
<td width=623 valign=top style='width:467.5pt;background:white;mso-background-themecolor:
background1;padding:0cm 14.2pt 0cm 14.2pt'>
<p class=MsoNormal align=center style='text-align:center;mso-element:frame;
mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:
margin;mso-element-top:-11.25pt;mso-height-rule:exactly'><span
style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:VIC;color:#7F7F7F;
mso-themecolor:text1;mso-themetint:128'><o:p>&nbsp;</o:p></span></p>
</td>
</tr>
<tr style='mso-yfti-irow:4;mso-yfti-lastrow:yes'>
<td width=623 valign=top style='width:467.5pt;background:black;mso-background-themecolor:
text1;padding:0cm 14.2pt 0cm 14.2pt'>
<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
style='border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
mso-yfti-tbllook:1184;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
<td width=195 valign=top style='width:146.2pt;border:solid windowtext 1.0pt;
mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
<p class=MsoNormal style='margin-top:12.0pt;margin-right:0cm;margin-bottom:
6.0pt;margin-left:0cm;mso-element:frame;mso-element-frame-hspace:9.0pt;
mso-element-wrap:around;mso-element-anchor-horizontal:margin;mso-element-top:
-11.25pt;mso-height-rule:exactly'><span class=SpellE><b><span
style='font-size:14.0pt;mso-bidi-font-size:18.0pt;font-family:Montserrat;
color:white;mso-themecolor:background1'>CovidVault</span></b></span><b><span
style='font-size:14.0pt;mso-bidi-font-size:18.0pt;font-family:Montserrat;
color:white;mso-themecolor:background1'><o:p></o:p></span></b></p>
<p class=MsoNormal style='mso-element:frame;mso-element-frame-hspace:9.0pt;
mso-element-wrap:around;mso-element-anchor-horizontal:margin;mso-element-top:
-11.25pt;mso-height-rule:exactly'><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:Montserrat;color:#7F7F7F;mso-themecolor:text1;
mso-themetint:128'>Contact registration made in North Melbourne by Simple
Programming.<o:p></o:p></span></p>
</td>
<td width=195 valign=top style='width:146.2pt;border:solid windowtext 1.0pt;
border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
<p class=MsoNormal style='margin-top:12.0pt;margin-right:0cm;margin-bottom:
6.0pt;margin-left:0cm;mso-element:frame;mso-element-frame-hspace:9.0pt;
mso-element-wrap:around;mso-element-anchor-horizontal:margin;mso-element-top:
-11.25pt;mso-height-rule:exactly'><b><span style='font-size:14.0pt;
mso-bidi-font-size:18.0pt;font-family:Montserrat;color:white;mso-themecolor:
background1'>Contact Info<o:p></o:p></span></b></p>
<p class=MsoNormal style='mso-element:frame;mso-element-frame-hspace:9.0pt;
mso-element-wrap:around;mso-element-anchor-horizontal:margin;mso-element-top:
-11.25pt;mso-height-rule:exactly'><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:Montserrat;color:white;mso-themecolor:background1'><a
href="tel:+61390133909"><span style='color:white;mso-themecolor:background1;
text-decoration:none;text-underline:none'>03 9013 3909</span></a> <a
href="mailto:hi@covidvault.com.au"><span style='color:white;mso-themecolor:
background1;text-decoration:none;text-underline:none'>hi@covidvault.com.au</span></a><o:p></o:p></span></p>
</td>
<td width=195 valign=top style='width:146.2pt;border:solid windowtext 1.0pt;
border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
<p class=MsoNormal style='margin-top:12.0pt;margin-right:0cm;margin-bottom:
6.0pt;margin-left:0cm;mso-element:frame;mso-element-frame-hspace:9.0pt;
mso-element-wrap:around;mso-element-anchor-horizontal:margin;mso-element-top:
-11.25pt;mso-height-rule:exactly'><b><span style='font-size:14.0pt;
mso-bidi-font-size:18.0pt;font-family:Montserrat;color:white;mso-themecolor:
background1'>Useful Links<o:p></o:p></span></b></p>
<p class=MsoNormal style='mso-element:frame;mso-element-frame-hspace:9.0pt;
mso-element-wrap:around;mso-element-anchor-horizontal:margin;mso-element-top:
-11.25pt;mso-height-rule:exactly'><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:Montserrat;color:white;mso-themecolor:background1'><a
href="https://www.covidvault.com.au/"><span style='color:white;mso-themecolor:
background1;text-decoration:none;text-underline:none'>Homepage</span></a><o:p></o:p></span></p>
<p class=MsoNormal style='mso-element:frame;mso-element-frame-hspace:9.0pt;
mso-element-wrap:around;mso-element-anchor-horizontal:margin;mso-element-top:
-11.25pt;mso-height-rule:exactly'><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:Montserrat;color:white;mso-themecolor:background1'><a
href="https://www.covidvault.com.au/dashboard"><span style='color:white;
mso-themecolor:background1;text-decoration:none;text-underline:none'>Dashboard</span></a><o:p></o:p></span></p>
<p class=MsoNormal style='mso-element:frame;mso-element-frame-hspace:9.0pt;
mso-element-wrap:around;mso-element-anchor-horizontal:margin;mso-element-top:
-11.25pt;mso-height-rule:exactly'><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:Montserrat;color:white;mso-themecolor:background1'><a
href="https://github.com/SimpleProgrammingAU/CovidVaultAPP/issues"><span
style='color:white;mso-themecolor:background1;text-decoration:none;
text-underline:none'>Check-in <span class=SpellE>Bugtracker</span></span></a><o:p></o:p></span></p>
<p class=MsoNormal style='mso-element:frame;mso-element-frame-hspace:9.0pt;
mso-element-wrap:around;mso-element-anchor-horizontal:margin;mso-element-top:
-11.25pt;mso-height-rule:exactly'><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:Montserrat;color:white;mso-themecolor:background1'><a
href="https://github.com/SimpleProgrammingAU/CovidVaultDash/issues"><span
style='color:white;mso-themecolor:background1;text-decoration:none;
text-underline:none'>Dashboard <span class=SpellE>Bugtracker</span></span></a></span><span
style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:Montserrat;
color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'><o:p></o:p></span></p>
</td>
</tr>
</table>
<p class=MsoNormal align=center style='text-align:center;mso-element:frame;
mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-horizontal:
margin;mso-element-top:-11.25pt;mso-height-rule:exactly'><span
style='font-size:10.0pt;mso-bidi-font-size:11.0pt;font-family:Montserrat;
color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'><o:p>&nbsp;</o:p></span></p>
<p class=MsoNormal style='mso-element:frame;mso-element-frame-hspace:9.0pt;
mso-element-wrap:around;mso-element-anchor-horizontal:margin;mso-element-top:
-11.25pt;mso-height-rule:exactly'><span style='font-size:10.0pt;mso-bidi-font-size:
11.0pt;font-family:Montserrat;color:#7F7F7F;mso-themecolor:text1;mso-themetint:
128'>© 2020 Simple Programming</span><span style='font-size:10.0pt;
mso-bidi-font-size:11.0pt;font-family:VIC;color:#7F7F7F;mso-themecolor:text1;
mso-themetint:128'><o:p></o:p></span></p>
</td>
</tr>
</table>
<p class=MsoNormal><span style='font-size:10.0pt;mso-bidi-font-size:11.0pt;
font-family:VIC;color:#7F7F7F;mso-themecolor:text1;mso-themetint:128'><o:p>&nbsp;</o:p></span></p>
</div>
</body>
</html>

--[UID]--
CONTENT;