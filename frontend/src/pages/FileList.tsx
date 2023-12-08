import { ReactElement } from "react";
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table"
import { useFileContext } from "@/context";

function FileList(): ReactElement {
  const { state: { fileList }, dispatch } = useFileContext();

    return (
      <>
        <h1 className="text-2xl font-bold pt-5 text-green-800">File List</h1>

        <Table>
          <TableCaption>A list of your files.</TableCaption>
          <TableHeader>
            <TableRow>
              <TableHead className="w-[100px]">Id</TableHead>
              <TableHead>File</TableHead>
              <TableHead>Uploaded At</TableHead>
              <TableHead className="text-right">Size (bytes)</TableHead>
            </TableRow>
          </TableHeader>
          <TableBody>
            <TableRow>
              <TableCell className="font-medium">INV001</TableCell>
              <TableCell>Paid</TableCell>
              <TableCell>Credit Card</TableCell>
              <TableCell className="text-right">R$25.000,00</TableCell>
            </TableRow>
          </TableBody>
        </Table>
      </>
    )
}

export { FileList };
