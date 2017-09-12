
/**
 * Created by PhpStorm.
 * User: berne
 * Date: 15/06/2017
 * Time: 11:40
 */
<?php
$Table = new STable();

// add table header
$Table->thead()
    ->th("col1")
    ->th("col2")
    ->th("col3");

// add a row
$Table->tr()
    ->td("val1")
    ->td("val2")
    ->td("val3");

// add another row
$Table->tr()
    ->td("val4")
    ->td("val5")
    ->td("val6");

// display table
print $Table->getTable();?>
This example will create this table:
<table border="0" cellpadding="3" cellspacing="0">
<thead>
<th>col1</th>
<th>col2</th>
<th>col3</th>
</thead>
<tr>
<td>val1</td>
<td>val2</td>
<td>val3</td>
</tr>
<tr>
<td>val4</td>
<td>val5</td>
<td>val6</td>
</tr>
</table>

You can also set table attributes, here is an example:<?php
$Table = new STable();
$Table->attributes = "bgcolor=\"#ccc\"";
$Table->border = 1;
$Table->cellpadding = 3;
$Table->cellspacing = 1;
$Table->class = "test_class";
$Table->width = "100%";

$Table->thead("example_thead_class", "id=\"example_tr_id\"")
    ->th("col1", null, "align=\"left\"")
    ->th("col2")
    ->th("col3");

$Table->tr("tr_class")
    ->td("val1", "example_td_class", "id=\"example_td_id\"")
    ->td("val2")
    ->td("val3");

$Table->tr(null, "valign=\"top\"")
    ->td("val4")
    ->td("val5")
    ->td("val6");

print $Table->getTable();?>
This example will output this table:
<table border="1" class="test_class" bgcolor="#ccc" width="100%" cellpadding="3" cellspacing="1">
<thead class="example_thead_class" id="example_tr_id">
<th align="left">col1</th>
<th>col2</th>
<th>col3</th>
</thead>
<tr class="tr_class">
<td class="example_td_class" id="example_td_id">val1</td>
<td>val2</td>
<td>val3</td>
</tr>
<tr valign="top">
<td>val4</td>
<td>val5</td>
<td>val6</td>
</tr>
</table>

This class also works well with data (like arrays), here is an example:
<?php
$data = array(
    array("val1", "val2", "val3"),
    array("val4", "val5", "val6")
);

$Table = new STable();

foreach($data as $tr) {
    $Table->tr();
    foreach($tr as $td) {
        $Table->td($td);
    }
}

print $Table->getTable();?>
Which would output this table:
<table border="0" cellpadding="3" cellspacing="0">
<tr>
<td>val1</td>
<td>val2</td>
<td>val3</td>
</tr>
<tr>
<td>val4</td>
<td>val5</td>
<td>val6</td>
</tr>
</table>