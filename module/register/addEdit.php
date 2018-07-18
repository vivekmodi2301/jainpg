<?php
	if(isset($_POST['department'])){
		
	}
?>
<table border="1px">
<form method="post" >
<tr>
	<th>
	<label>Department:</label>
    </th>
    <td>
	<select name="department">
    	<option value="arts">Arts</option>
        <option value="commerce">Commerce</option>
        <option value="computer">Computer</option>
    </select>
    </td>
</tr>
<tr>
	<th>
    <label>UG/PG:</label>
    </th>
    <td>
    <select name="ugpg">
    	<option value="ug">Under Graduate</option>
        <option value="pg">Post Graduate</option>
    </select>
    </td>
</tr>
<tr>
	<th>
    <label>Course:</label>
    </th>
    <td>
    <select name="course">
    <option value="ba">B.A.(with Computer Application)</option>
    <option value="bcom">B.com(with Business Managment/ Computer Application)</option>
    <option value="bca">B.C.A</option>
    <option value="msci">M.Sc.(IT)</option>
    <option value="mscc">M.Sc.(CS)</option>
    <option value="mcom">M.com.(ABST)</option>
    <option value="ma">M.A.(English Literature)</option>
    </select>
    </td>
</tr>
<tr>
	<th>
    <label>Compulsory Subject:</label>
    </th>
    <td>
    <input type="checkbox" name="compulsorysub[]" value="english">English
    <input type="checkbox" name="compulsorysub[]" value="hindi">Hindi
    <input type="checkbox" name="compulsorysub[]" value="computer">Ele. Computer Application
    <input type="checkbox" name="compulsorysub[]" value="env">Env. Studies
    </td>
</tr>
<tr>
	<th>
    <label>Optional Subjects:</label>
    </th>
    <td>
    <input type="checkbox" name="optionalsub[]" value="">Awain<br>
    </td>
</tr>
<tr>
	<th>
    <label>Student Name:</label>
    </th>
    <td>
    <input type="text" name="name">
    </td>
</tr>
<tr>
	<th>
    <label>Father's Name:</label>
    </th>
    <td>
    <input type="text" name="fname">
    </td>
</tr>
<tr>
	<th>
    <label>Mother's Name:</label>
    </th>
    <td>
    <input type="text" name="mname">
    </td>
</tr>
<tr>
	<th>
    <label>Are you belong to Rajasthan:</label>
    </th>
    <td>
    <input type="radio" name="resident" value="y">Yes
    <input type="radio" name="resident" value="n">No
    </td>
</tr>
<tr>
	<th>
    <label>Parents Name(If Depended Child):</label>
    </th>
    <td>
    <input type="text" name="" value="">
    <input type="text" name="" placeholder="relation with student" >
    </td>
</tr>
<tr>
	<th>
    <label>Category:</label>
    </th>
    <td>
    <select name="category">
    	<option value="gen">Gen.</option>
        <option value="obc">OBC</option>
        <option value="sc">SC</option>
        <option value="st">ST</option>
        <option value="sbc">SBC</option>
        <option value="saharia">Saharia</option>
    </select>
    </td>
</tr>
<tr>
	<th>
    <label>Cast:</label>
    </th>
    <td>
   	<input type="text" name="cast">
    
    </td>
</tr>
<tr>
	<th>
    <label>Handicapt:</label>
    </th>
    <td>
    <input type="radio" name="" value="">Yes
    <input type="radio" name="" value="">No
    <textarea name="" readonly></textarea>
    
    </td>
</tr>
<tr>
	<th>
    <label>Address:</label>
    </th>
    <td>
    <textarea name="address"></textarea>
    </td>
</tr>
<tr>
	<th>
    <label>City/Village:</label>
    </th>
    <td>
    <input type="text" name="city">
    
    </td>
</tr>
<tr>
	<th>
    <label>Tahsil:</label>
    </th>
    <td>
  	<input type="text" name="tahsil">
    </td>
</tr>
<tr>
	<th>
    <label>District:</label>
    </th>
    <td>
  	<input type="text" name="district">
    </td>
</tr>
<tr>
	<th>
    <label>Pin Code:</label>
    </th>
    <td>
    <input type="text" name="pincode">
    
    </td>
</tr>
<tr>
	<th>
    <label>Phone No.:</label>
    </th>
    <td>
  	<input type="text" name="phone">
    </td>
</tr>
<tr>
	<th>
    <label>Mobile No.</label>
    </th>
    <td>
  	<input type="text" name="mobile">
    </td>
</tr>
<tr>
	<th>
    <label>Voter Id No.:</label>
    </th>
    <td>
    <input type="text" name="voter">
    </td>
</tr>
<tr>
	<th>
    <label>Adhar Card No.:</label>
    </th>
    <td>
    <input type="text" name="adhar">
    </td>
</tr>
<tr>
	<th>
    <label>Date</label>
    </th>
    <td>
    <input type="date" name="dt">
    </td>
</tr>
<tr>
<td colspan="2">
	<table border="1px">
    	<tr>
        	<th>Examination Name</th>
            <th>Passout Year</th>
            <th>Roll No.</th>
            <th>Subject</th>
            <th>Obtained Marks</th>
            <th>Total Marks</th>
            <th>Percentage</th>
            <th>Section</th>
            <th>Organization Name/ Private</th>
            <th>Board/ University Name</th>
        </tr>
        <tr>
        	<td>Sr. Sec. School</td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
        </tr>
        <tr>
        	<td>First Year</td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
        </tr>
        <tr>
        	<td>Second Year</td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
        </tr>
        <tr>
        	<td>Third Year</td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><input type="text"></td>
        </tr>
    </table>
</td>
</tr>
</table>
</form>  