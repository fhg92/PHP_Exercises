<html>
    <body>
        <form action='CSVScript.php' method='post'>
            <div>
                <input type='text' name='fileName' placeholder='filename'/>
            </div>
            <br>
            <div>
                <input type='text' name='row1[]' placeholder='A1'/>
                <input type='text' name='row1[]' placeholder='B1'/>
                <input type='text' name='row1[]' placeholder='C1'/>
            </div>
                <input type='text' name='row2[]' placeholder='A2'/>
                <input type='text' name='row2[]' placeholder='B2'/>
                <input type='text' name='row2[]' placeholder='C2'/>
            <div>
                <input type='text' name='row3[]' placeholder='A3'/>
                <input type='text' name='row3[]' placeholder='B3'/>
                <input type='text' name='row3[]' placeholder='C3'/>
            </div>
            <br>
            <input type='submit' name='submit'/>
        </form>
    </body>
</html>