<?php
include "./dbconnect.php";

if (isset($_POST['submit'])) {
    $error = '';
    $error_msg = '';
    $success_msg = '';

    if (empty($_POST['family-member'])) {
        $error = "Please enter family member";
    } else if (empty($_POST['age'])) {
        $error = "Please enter age";
    } else if (empty($_POST['occupation'])) {
        $error = "Please enter occupation";
    } else if (empty($_POST['work-place'])) {
        $error = "Please enter work place";
    } else {

        $family_member = $con->real_escape_string($_POST['family-member']);
        $age = $con->real_escape_string($_POST['age']);
        $occupation = $con->real_escape_string($_POST['occupation']);
        $work_place = $con->real_escape_string($_POST['work-place']);

        $chkSql = "SELECT * FROM family WHERE family_members = '$family_member'";

        $res = $con->query($chkSql);
        // print_r($res->num_rows);die;
        if ($res->num_rows > 0) {
            $error_msg = "Family member exists";

        } else {
            $sql1 = "INSERT INTO family (family_members, age) values ('$family_member', '$age')";
            if ($con->query($sql1) === true) {
                $family_memberId = $con->insert_id;

                //Insert data into occupation table
                $sql2 = "INSERT INTO occupations (occupation, work_place, family_member) values ('$occupation', '$work_place', '$family_memberId')";
                if ($con->query($sql2) === true) {
                    $success_msg = "Family data inserted successfully";
                } else {
                    $error_msg = "Failed to insert data";
                }
            }
        }

    }

}

$sql = "SELECT family.family_members, family.age, occupations.occupation, occupations.work_place
FROM family INNER JOIN occupations ON family.id = occupations.family_member";
//print_r($sql);die;
$res = $con->query($sql);
$families = [];
while ($row = $res->fetch_object()) {
    $families[] = $row;
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Family Data Form</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	</head>
	<body>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row mt-3 justify-content-center">

					<div class="col-sm-6 ">
						  <?php if (isset($error_msg) && strlen($error_msg) > 1): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error_msg; ?>
                            </div>
                        <?php endif?>

                        <?php if (isset($success_msg) && strlen($success_msg) > 1): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $success_msg; ?>
                            </div>
                        <?php endif?>
						<h1 class="text-center">Family Data</h1>
						<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
							<div class="form-group">
								<label for="exampleInputEmail1">Family member</label>
								<input type="text" name="family-member" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter family member">
							  <small class="form-text text-danger"><?php echo isset($error) ? $error : null ?></small>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Age</label>
								<input type="text" name="age" class="form-control" id="exampleInputPassword1" placeholder="Enter age">
								 <small class="form-text text-danger"><?php echo isset($error) ? $error : null ?></small>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Occupation</label>
								<input type="text" name="occupation" class="form-control" id="exampleInputPassword1" placeholder="Enter Occupation">
								 <small class="form-text text-danger"><?php echo isset($error) ? $error : null ?></small>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Work Place</label>
								<input type="text" name="work-place" class="form-control" id="exampleInputPassword1" placeholder="Enter Work Place">
								 <small class="form-text text-danger"><?php echo isset($error) ? $error : null ?></small>
							</div>
							<button type="submit" name="submit" class="btn btn-primary">Submit</button>
						</form>
					</div>
				</div>
				<div class="row mt-5">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Sl No</th>
								<th scope="col">Family Members</th>
								<th scope="col">Age</th>
								<th scope="col">Occupation</th>
								<th scope="col">Work Place</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 0;foreach ($families as $family): ?>
							<tr>
								<th scope="row"><?php echo $i + 1; ?></th>
								<td><?php echo $family->family_members ?></td>
								<td><?php echo $family->age ?></td>
								<td><?php echo $family->occupation ?></td>
								<td><?php echo $family->work_place ?></td>
							</tr>
							<?php $i++;endforeach?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- bootstrap js -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>
