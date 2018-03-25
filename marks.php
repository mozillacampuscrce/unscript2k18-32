<?php
    include('config.php');
    session_start();
    $td = date('Y-m-d');
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Attendance and Marks Management</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
  function loadsub() {
    var selsub = document.getElementById("selsub");
    var yr = document.getElementById("yr").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
            selsub.innerHTML = this.responseText;
    };
    xmlhttp.open("GET", "loadsub.php?yr=" + yr, true);
    xmlhttp.send();
  }
  </script>
</head>
<body>
<div class="container">
  <h4 class="float">
  <a href="view_marks.php">View Exam Marks</a>
  </h4>
  <h4><a href="index.php" class="btn btn-info" role="button">Back</a></h4>
  <h2>Enter Exam Marks</h2>
  <form class="form-horizontal" method="post" action="attendance.php">
  <input type="hidden" name="action" value="attendance">
  <div class="form-group">
    <label class="control-label col-sm-2">Year:</label>
    <div class="col-sm-5">
      <select class="form-control" name="year" onchange="loadsub('')" id="yr">
        <option disabled selected>-- Select a Year --</option>
        <option>FE</option>
        <option>SE</option>
        <option>TE</option>
        <option>BE</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Division:</label>
    <div class="col-sm-5">
      <select class="form-control" name="division">
        <option>A</option>
        <option>B</option>
      </select> 
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Subject:</label>
    <div class="col-sm-5">
      <select class="form-control" name="subject" id="selsub">
        <?php
        if($flag && $subs!="") echo $subs;
        else echo "<option>-- Select Year to load Subjects --</option>";
        ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Date:</label>
    <div class="col-sm-5">
      <input type="date" class="form-control" name="date" placeholder="Enter date" <?php echo "value=\"$td\""; ?> >
    </div>
  </div>  
  <div class="form-group">
    <label class="control-label col-sm-2">Exam Type:</label>
    <div class="col-sm-5">

      <input list="types" name="type" class="form-control">
      <datalist id="types">
        <option value="Term Test - 1">
        <option value="Term Test - 2">
        <option value="End Sem Exam">
      </datalist>

    </div>
  </div>

    <table class="table table-hover table-border">
      <thead>
        <th>Roll No.</th>
        <th>Marks</th>
        <th>Roll No.</th>
        <th>Marks</th>
        <th>Roll No.</th>
        <th>Marks</th>
        <th>Roll No.</th>
        <th>Marks</th>
        <th>Roll No.</th>
        <th>Marks</th>
      </thead>
      <tbody>
        <tr>
<td>1</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>2</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>3</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>4</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>5</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
</tr>
<tr>
<td>6</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>7</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>8</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>9</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>10</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
</tr>
<tr>
<td>11</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>12</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>13</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>14</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>15</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
</tr>
<tr>
<td>16</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>17</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>18</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>19</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>20</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
</tr>
<tr>
<td>21</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>22</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>23</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>24</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>25</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
</tr>
<tr>
<td>26</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>27</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>28</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>29</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>30</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
</tr>
<tr>
<td>31</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>32</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>33</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>34</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>35</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
</tr>
<tr>
<td>36</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>37</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>38</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>39</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>40</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
</tr>
<tr>
<td>41</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>42</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>43</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>44</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>45</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
</tr>
<tr>
<td>46</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>47</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>48</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>49</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>50</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
</tr>
<tr>
<td>51</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>52</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>53</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>54</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>55</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
</tr>
<tr>
<td>56</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>57</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>58</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>59</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>60</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
</tr>
<tr>
<td>61</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>62</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>63</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>64</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>65</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
</tr>
<tr>
<td>66</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>67</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>68</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>69</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>70</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
</tr>
<tr>
<td>71</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>72</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>73</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>74</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>75</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
</tr>
<tr>
<td>76</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>77</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>78</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>79</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>80</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
</tr>
<tr>
<td>81</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>82</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>83</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>84</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>85</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
</tr>
<tr>
<td>86</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>87</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>88</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>89</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
<td>90</td><td><input type="number" min=0 max=100 required class="form-control" name="marks[]"></div></td>
</tr>
      </tbody>
    </table>
  </div>

  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-5">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
</div>
</body>
</html>
