{ pkgs }: {
	deps = [
		pkgs.sqlite.bin
  pkgs.systemdMinimal
  pkgs.mysql80
  pkgs.php74
	];
}