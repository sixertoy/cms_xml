<?php

namespace Bluemagic\Utils;

use DirectoryIterator;

class Cache
{
	static public function clear( $pPath )
	{
		$ds = DIRECTORY_SEPARATOR;
		$iterator = new DirectoryIterator( $pPath );
		foreach( $iterator as $fileInfo )
		{
			if( $fileInfo->isDir() ) continue;
			if( $fileInfo->isDot() ) continue;
			if( $fileInfo->isFile() )
			{
				$file =$fileInfo->getFileName();
				$filePath = $pPath.$ds.$file;
				@unlink( $filePath );
			}
		}		
	}
}