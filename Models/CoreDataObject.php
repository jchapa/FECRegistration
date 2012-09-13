<?php
abstract class CoreDataObject
{
    protected $m_DataContext;

    public function __construct(
        $strHost,
        $strDatabaseName,
        $strUsername,
        $strPassword
        )
    {
        $strDSN = "mysql:host=" . $this->m_strHost .
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
     * return the result set from the select.
     * @param array $aQuery
     * @return int, PDOStatement
     */
    public function DoQueries($aQuery)
    {
        $mRetval = null;
        $this->m_DataContext->beginTransaction();
        foreach ($mQuery as $strQuery)
        {
            if (false !== strpos(strtolower($strQuery), 'select'))
            {
                // if we're doing a select, we don't want to iterate
                // through it all
                $mRetval = $this->m_DataContext->query($strQuery);
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
                // We don't check for a failure here because 
                $this->m_DataContext->exec($strQuery);
            }
        }
        // else let's commit it!
        $mRetval = $this->m_DataContext->commit();
        return $mRetval;
    }
}