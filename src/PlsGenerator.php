<?php
	/** PLS Playlist Generator
	 *
	 * @author		Jan Pecha, <janpecha@email.cz>
	 * @license		New BSD License
	 */

	namespace Cz;

	class PlsGenerator
	{
		const MIME_TYPE = 'audio/x-scpls';

		/** @var  string[] */
		private $tracks = array();



		/**
		 * @param	string|array
		 * @param	string
		 * @param	int
		 * @throws	Exception
		 * @return	$this
		 */
		public function addTrack($file, $title = NULL, $length = NULL)
		{
			if(is_array($file))
			{
				$title = (isset($file['title'])) ? $file['title'] : 'Unknow';
				$length = (isset($file['length'])) ? $file['length'] : FALSE;

				if(isset($file['file']))
				{
					$file = $file['file'];
				}
				else
				{
					throw new \Exception('Filename is undefined.');
				}
			}

			if($length === NULL || $length === FALSE)
			{
				$length = '-1'; // indefinite
			}
			else
			{
				$length = (int)$length;
			}

			$this->tracks[] = array(
				'file' => (string)$file,
				'title' => $title,
				'length' => $length,
			);

			return $this;
		}



		/**
		 * @param	string[]
		 * @return	$this
		 */
		public function addTracks(array $tracks)
		{
			foreach($tracks as $track)
			{
				$this->addTracks($track);
			}

			return $this;
		}



		/**
		 * @param	string
		 * @return	int|FALSE
		 */
		public function save($filename)
		{
			return file_put_contents($filename, $this->generate());
		}



		/**
		 * @return	string
		 */
		public function generate()
		{
			// Header
			$data = "[playlist]\n\n";
			$number = 0;

			// Tracks
			foreach($this->tracks as $i => $track)
			{
				$data .= 'File' . ($i + 1) . "={$track['file']}\n";
				$data .= 'Title' . ($i + 1) . "={$track['title']}\n";
				$data .= 'Length' . ($i + 1) . "={$track['length']}\n\n";

				$number++;
			}

			// Footer
			$data .= "\nNumberOfEntries=$number\n";
			$data .= "Version=2";

			return $data;
		}



		/**
		 * @return	string
		 */
		public function __toString()
		{
			return $this->generate();
		}
	}

