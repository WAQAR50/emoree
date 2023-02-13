<?php

/*
* Add Database file
* Database connection
* Add header file
* Dynamic HTML head
* Get Result of Students
* Reading exercise
* Add footer file
* Dynamic closing tags of HTML

*/
require_once 'database.php';

require_once 'header.php';


$sql = "SELECT t1.user_id, t3.level, t3.section, t4.school, AVG(t5.stufe) as Stufe, AVG( t7.words/nullif(t1.reading_time, 0) ) AS WPM,
    count(t1.reading_test_id) as Exercises, min_dates.first_result, final_results.final_result 
    FROM  reading__answers t1
    JOIN school__pupils t2 ON t1.user_id = t2.user_id
    JOIN reading__tasks t5 ON t1.task_number = t5.id
    JOIN reading__texts t7 ON t5.text_id = t7.id
    JOIN school__classes t3 ON t2.class_id = t3.id
    JOIN school__partners t4 ON t3.school_id = t4.id
    JOIN reading__tests t6 ON t1.reading_test_id = t6.id
    JOIN  (SELECT user_id, (correct_answers/5 * 100) AS first_result
    FROM  reading__answers  GROUP BY user_id HAVING MIN(timestamp)) AS min_dates
    ON min_dates.user_id = t1.user_id 
    JOIN  (SELECT user_id, (SUM(correct_answers)/(COUNT(correct_answers)*5) * 100) AS final_result
    FROM  reading__answers  GROUP BY user_id ) AS final_results
    ON final_results.user_id = t1.user_id 
    GROUP BY t1.user_id";

$result = $conn->query($sql);
?>
<!-- View exercise results of students -->
<div class="table-responsive">
    <table class="table table-striped table-hover align-middle text-center">
        <thead>
            <th>S.No</th>
            <th>School</th>
            <th>Class</th>
            <th>User id</th>
            <th>Stufe</th>
            <th>WPM</th>
            <th>Start correctness (%)</th>
            <th>Correctness (%)</th>
            <th>Exercises</th>
        </thead>
        <?php 

if ($result->num_rows > 0) {
    $count = 1;
    while($row = mysqli_fetch_object($result)) {
       
       ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row->school; ?></td>
            <td><?php echo $row->level.$row->section; ?></td>
            <td><?php echo $row->user_id; ?></td>
            <td><?php echo $row->Stufe; ?></td>
            <td><?php echo $row->WPM; ?></td>
            <td><?php echo $row->first_result; ?></td>
            <td><?php echo $row->final_result; ?></td>
            <td><?php echo $row->Exercises; ?></td>

        </tr>
        <?php
    $count++;
    }
} else {
    echo "0 results";
}
?>
    </table>
</div>
<!-- End View exercise results of students -->
<?php
mysqli_close($conn);


require_once 'footer.php';