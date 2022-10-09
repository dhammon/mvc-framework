<?php
namespace Core;
/*
 * to use
 * new DBHelper()
 * $DBHelper->connect(creds)
 * $result = $DBHelper->query(query, type, arg1, ...)
 * $numRows = $result->numRows
 * $array = $result->fetchArray()
 */


class DBHelper
{
    protected $connection;
    protected $query;

    public function startTransaction()
    {
        $this->connection->query("START TRANSACTION");
    }

    public function commitTransaction()
    {
        $this->connection->query("COMMIT");
    }

    public function fetchArray($mode = MYSQLI_BOTH)     //mode can be MYSQLI_NUM or MYSQLI_ASSOC
    {
        $result = $this->query->get_result();
        $array = null;

        while($row = $result->fetch_array($mode))
        {
            $array[] = $row;
        }

        return $array;
    }
    
    public function numberRows()
    {
        $this->query->store_result();
        return $this->query->num_rows;
    }

    public function query($query)
    {
        $statement = $this->prepareStatement($query);

        if(func_num_args() > 1)
        {
            $queryAndArgs = func_get_args();
            $args = array_slice($queryAndArgs, 1);
            $this->validateArgs($queryAndArgs);

            $parameters[] = $args[0];

            for($i=1; $i<count($args); $i++)
            {
                $parameters[] = &$args[$i];
            }

            $statement = $this->bindParameters($statement, $parameters);
        }

        $this->query = $this->executeStatement($statement);

        return $this;
    }

    private function validateArgs($queryAndArgs)
    {
        $this->validateOneArg($queryAndArgs);
        $this->validateQueryParameterMatch($queryAndArgs);
        $this->validateType($queryAndArgs);
        $this->validateTypeParameterMatch($queryAndArgs);
    }

    private function validateTypeParameterMatch($queryAndArgs)
    {
        $type = $queryAndArgs[1];
        $paramCount = count($queryAndArgs) - 2;
        if(strlen($type) !== $paramCount)
        {
            throw new \Exception("Bind parameter fail - type and parameter mismatch");
        }
    }

    private function validateType($queryAndArgs)
    {
        $type = $queryAndArgs[1];
        if(!preg_match("#^[sdi]+$#", $type))
        {
            throw new \Exception("Bind parameter fail - type must be s, d, or i");
        }
    }

    private function validateQueryParameterMatch($queryAndArgs)
    {
        $queryParams = substr_count($queryAndArgs[0], "?");
        $paramCount = count($queryAndArgs) - 2;
        if($queryParams !== $paramCount)
        {
            throw new \Exception("Bind parameter fail - query and parameter mismatch");
        }
    }

    private function validateOneArg($queryAndArgs)
    {
        if(count($queryAndArgs) === 2)
        {
            throw new \Exception("Bind parameter fail - one arg");
        }
    }

    private function executeStatement($statement)
    {
        if (!($statement->execute()))
        {
            throw new \Exception("Statement execution failed");
        }

        return $statement;
    }

    private function bindParameters($statement, $parameters)
    {
        try
        {
            if(!(call_user_func_array(array($statement, "bind_param"), $parameters)))
            {
                throw new \Exception("Bind parameters failed");
            }

            return $statement;
        }
        catch (\Exception $exception)
        {
            throw new \Exception("Bind parameters failed");
        }
    }

    private function prepareStatement($query)
    {
        if(!$statement = $this->connection->prepare($query))
        {
            throw new \Exception("Prepare statement failed");
        }

        return $statement;
    }

    public function closeConnection()
    {
        $this->connection->close();
        $this->connection = null;
    }

    public function connect($host, $user, $pass, $database, $charSet)
    {
        $this->connection = new \mysqli($host, $user, $pass, $database);
        $this->connection->set_charset($charSet);

        if($this->connection->connect_error)
        {
            throw new \Exception("Database connection failed!");
        }
    }
}