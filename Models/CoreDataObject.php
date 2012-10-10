<?php
class CoreDataObject
{
    protected $m_DataContext;
    // HACK - using this instead of formal configuration
    protected $m_dbHost = "localhost";
    protected $m_dbName = "fec";
    protected $m_dbPass = "fec!@#pass#@!";
    protected $m_dbUser = "fec";
    
    public function __construct(
        $strHost = null,
        $strDatabaseName = null,
        $strUsername = null,
        $strPassword = null
        )
    {
        // Do we have a connection string?
        if (null === $strHost ||
            null === $strDatabaseName ||
            null === $strUsername ||
            null === $strPassword
            )
        {
            $strHost = $this->m_dbHost;
            $strDatabaseName = $this->m_dbName;
            $strUsername = $this->m_dbUser;
            $strPassword = $this->m_dbPass;
        }
        // Let's make a data object
        $strDSN = "mysql:host=" . $strHost .
            ";dbname=" . $strDatabaseName;
        $this->m_DataContext = new PDO(
            $strDSN, 
            $strUsername,
            $strPassword
            );

        unset($strDSN);
    }
    
    /**
     * Performs the bulk modifcation operations or single select,
     * returning false on commit failure or whether the modification
     * transaction succeeded.
     * WARNING!! if a select is passed in, it will halt execution and
     * return the result set from the first select.
     * @param array $aQuery
     * @return int, PDOStatement
     */
    public function DoQueries($aQuery)
    {
        $mRetval = null;
        $this->m_DataContext->beginTransaction();
        foreach ($aQuery as $strQuery)
        {
            // probably a better way to do this. . .
            if (false === strpos(strtolower($strQuery), 'select'))
            {
                // if we're doing a select, we don't want to iterate
                // through it all
                $mRetval = $this->m_DataContext->exec($strQuery);
                if (false === $mRetval)
                {
                    $this->m_DataContext->rollBack();
                    unset($strQuery);
                    return $mRetval;
                }
                else
                {
                    return $mRetval;
                }
            }
            else
            {
                // We don't check for a failure here because it's a select
                foreach($this->m_DataContext->query($strQuery) as $aRet)
                {
                    // Let's toggle to ignore the unneeded records that are returned
                    $bToggle = true;
                    foreach ($aRet as $aKey => $aCol)
                    {
                        if ($bToggle)
                        {
                            $mRetval[$aKey] = $aCol;
                            $bToggle = false;
                        }
                        else
                        {
                            $bToggle = true;
                        }
                    }
                    unset ($bToggle);
                }
                return $mRetval;
            }
        }
        // else let's commit it!
        $mRetval = $this->m_DataContext->commit();
        return $mRetval;
    }
}